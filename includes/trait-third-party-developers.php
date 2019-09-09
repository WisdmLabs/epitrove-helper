<?php

namespace Licensing;

trait ThirdPartyDevelopers {
        /**
         * Method for Third Party Developers to check if License of their product 
         * is active or not.
         * 
         *
         * @param string $productSlug productSlug defined in epitrove-config.php. It is name of the folder.
         * @return boolean Returns true if license key status is active.
         */
        public static function isActive($productSlug)
        {
            // Save status in an array, so that when this function is called
            // multiple times for same product, we don't have to do processing every time.
            static $products = [];

            if(isset($products[$productSlug])) {
                return $products[$productSlug];
            }

            $instance = self::getInstance();
            
            $product = array_filter($instance->getAllEpitroveProducts(), function($product) use ($productSlug){
                return $productSlug === $product->productSlug();
            });

            if(empty($product)) {
                $products[$productSlug] = false;
                return $products[$productSlug];
            }

            // Since array_filter returns an array, we'll have to access 1st element manually
            $product = array_pop($product);

            if ($product->isActiveLicense()) {
                $products[$productSlug] = true;
                return $products[$productSlug];
            }

            $products[$productSlug] = false;
            return $products[$productSlug];
        }

        /**
         * Method for Third Party Developers to read License Key added by customer for their product
         * 
         *
         * @param string $productSlug productSlug defined in epitrove-config.php. It is name of the folder.
         * @return string Returns blank string if license key for the product is not found.
         */
        public static function licenseKey($productSlug) {
            // Save license keys in an array, so that when this function is called
            // multiple times for same product, we don't have to do processing every time.
            static $licenseKeys = [];

            if(isset($licenseKeys[$productSlug])) {
                return $licenseKeys[$productSlug];
            }

            $instance = self::getInstance();
            
            $product = array_filter($instance->getAllEpitroveProducts(), function($product) use ($productSlug){
                return $productSlug === $product->productSlug();
            });

            if(empty($product)) {
                $licenseKeys[$productSlug] = '';
                return $licenseKeys[$productSlug];
            }

            // Since array_filter returns an array, we'll have to access 1st element manually
            $product = array_pop($product);

            $licenseKeys[$productSlug]  = $product->licenseKey();
            return $licenseKeys[$productSlug];
        }
}