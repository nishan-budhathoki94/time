<?php
/**
 * Time functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package ThemeGrill
 * @subpackage Time
 * @since Time 1.0
 */

/****************************************************************************************/

// T theme options
function spacious_options( $id, $default = false ) {
   // getting options value
   $spacious_options = get_option( 'spacious' );
   if ( isset( $spacious_options[ $id ] ) ) {
      return $spacious_options[ $id ];
   } else {
      return $default;
   }
}
