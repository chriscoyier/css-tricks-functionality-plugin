<?php
/**
 * Custom Pagination for the Archives 
 * based on WP Page Numbers
 * http://www.jenst.se/2008/03/29/wp-page-numbers
 *
 * @package     CTF
 * @subpackage  CTF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */
class Cust_Pagination {

    private static function wp_page_numbers_check_num( $num ) {
      return ( $num%2 ) ? true : false;
    }

    private static function wp_page_numbers_page_of_page( $max_page, $paged, $page_of_page_text, $page_of_of ) {
      $pagingString = "";
      if ( $max_page > 1) {
        $pagingString .= '<li class="page_info">';
        if( $page_of_page_text == "" ) {
          $pagingString .= 'Page ';
        } else {
          $pagingString .= $page_of_page_text . ' ';
        }
        if ( $paged != "" ) {
          $pagingString .= $paged;
        } else {
          $pagingString .= 1;
        }
        if( $page_of_of == "" ) {
          $pagingString .= ' of ';
        } else {
          $pagingString .= ' ' . $page_of_of . ' ';
        }
        $pagingString .= floor($max_page).'</li>';
      }

      return $pagingString;
    }

    private static function wp_page_numbers_prevpage( $paged, $max_page, $prevpage ) {
      if( $max_page > 1 && $paged > 1 ) {
        $pagingString = '<li><a href="'.get_pagenum_link($paged-1). '">'.$prevpage.'</a></li> ';
      }
      return $pagingString;
    }

    private static function wp_page_numbers_left_side( $max_page, $limit_pages, $paged, $pagingString ) {
      $pagingString = "";
      $page_check_max = false;
      $page_check_min = false;
      if( $max_page > 1 ) {
        for( $i=1; $i<( $max_page+1 ); $i++ ) {
          if( $i <= $limit_pages ) {
            if( $paged == $i || ( $paged == "" && $i == 1 ) ){
              $pagingString .= '<li class="active_page"><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
            } else {
              $pagingString .= '<li><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
            }
            if( $i == 1 ) {
              $page_check_min = true;
            }
            if($max_page == $i ) {
              $page_check_max = true;
            }
          }
        }

        return array( $pagingString, $page_check_max, $page_check_min );
      }
    }

    private static function wp_page_numbers_middle_side( $max_page, $paged, $limit_pages_left, $limit_pages_right ) {
      $pagingString = "";
      $page_check_max = false;
      $page_check_min = false;
      for( $i=1; $i<( $max_page+1 ); $i++ ) {
        if( $paged-$i <= $limit_pages_left && $paged+$limit_pages_right >= $i ) {
          if( $paged == $i ){
            $pagingString .= '<li class="active_page"><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
          } else {
            $pagingString .= '<li><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
          }
          if( $i == 1 ){
            $page_check_min = true;
          }
          if( $max_page == $i ){
            $page_check_max = true;
          }
        }
      }

      return array( $pagingString, $page_check_max, $page_check_min );
    }

    private static function wp_page_numbers_right_side( $max_page, $limit_pages, $paged, $pagingString ){
      $pagingString = "";
      $page_check_max = false;
      $page_check_min = false;
      for( $i=1; $i<( $max_page+1 ); $i++ ){
        if( ( $max_page + 1 - $i ) <= $limit_pages ){
          if( $paged == $i ){
            $pagingString .= '<li class="active_page"><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
          } else {
            $pagingString .= '<li><a href="'.get_pagenum_link( $i ). '">'.$i.'</a></li>'."\n";
          }
          if( $i == 1 ){
            $page_check_min = true;
          }
        }
        if( $max_page == $i ){
          $page_check_max = true;
        }
      }

      return array( $pagingString, $page_check_max, $page_check_min );
    }

    private static function wp_page_numbers_nextpage( $paged, $max_page, $nextpage ) {
      if( $paged != "" && $paged < $max_page ){
        $pagingString = '<li><a href="'.get_pagenum_link( $paged+1 ). '">'.$nextpage.'</a></li>'."\n";
      }

      return $pagingString;
    }

    public static function wp_page_numbers( $args = array() ) {
      global $wp_query;
      global $max_page;
      global $paged;

      $defaults = array(
        'page_of_page' => 'no', // Show Page Info: on/off
        'next_prev_text' => 'on', // Show next / previous page text: on/off
        'show_start_end_numbers' => 'on', // Show start and end numbers: on/off
        'show_page_numbers' => 'on', // Show page number: on/off
        'limit_pages' => '6', // Number of pages to show: default 10(0 => unlinited)
        'page_of_page_text' => '', // Defualt Text: Page
        'page_of_of' => '', // Default Text: of
        'nextpage' => '&gt;', // Next Page text
        'prevpage' => '&lt;', // Prevuios page text
        'startspace' => '...', // Start ellipsis
        'endspace' => '...', // End ellipsis
        );
      $args = array_merge( $defaults, $args );
      extract( $args );
      if ( !$max_page ) { 
        $max_page = $wp_query->max_num_pages; 
      }

      if ( !$paged ) { 
        $paged = 1; 
      }

      if( $limit_pages == "" ) { 
        $limit_pages = "10"; 
      } elseif ( $limit_pages == "0" ) { 
        $limit_pages = $max_page; 
      }

      if( self::wp_page_numbers_check_num( $limit_pages ) == true) {
        $limit_pages_left = ( $limit_pages-1 )/2;
        $limit_pages_right = ( $limit_pages-1 )/2;
      } else {
        $limit_pages_left = $limit_pages/2;
        $limit_pages_right = ( $limit_pages/2 )-1;
      }
      
      if( $max_page <= $limit_pages ) { 
        $limit_pages = $max_page; 
      }
      
      $pagingString = "<div id='wp_page_numbers'>\n";
      $pagingString .= '<ul>';
      
      if($page_of_page != "no"){
        $pagingString .= self::wp_page_numbers_page_of_page( $max_page, $paged, $page_of_page_text, $page_of_of );
      }
      
      if( ($paged) <= $limit_pages_left ) {
        list ($value1, $value2, $page_check_min) = self::wp_page_numbers_left_side( $max_page, $limit_pages, $paged, $pagingString );
        $pagingMiddleString .= $value1;
      } elseif( ($max_page+1 - $paged ) <= $limit_pages_right ) {
        list ( $value1, $value2, $page_check_min ) = self::wp_page_numbers_right_side( $max_page, $limit_pages, $paged, $pagingString );
        $pagingMiddleString .= $value1;
      } else {
        list ( $value1, $value2, $page_check_min ) = self::wp_page_numbers_middle_side( $max_page, $paged, $limit_pages_left, $limit_pages_right );
        $pagingMiddleString .= $value1;
      }
      if( $next_prev_text != "no" ) {
        $pagingString .= self::wp_page_numbers_prevpage( $paged, $max_page, $prevpage );
        if( $page_check_min == false && $show_start_end_numbers != "no" ) {
          $pagingString .= "<li class=\"first_last_page\">";
          $pagingString .= "<a href=\"" . get_pagenum_link( 1 ) . "\">1</a>";
          $pagingString .= "</li>\n<li  class=\"space\">".$startspace."</li>\n";
        }
      }
      if( $show_page_numbers != "no" ) {
        $pagingString .= $pagingMiddleString;
        if( $value2 == false && $show_start_end_numbers != "no" ) {
          $pagingString .= "<li class=\"space\">".$endspace."</li>\n";
          $pagingString .= "<li class=\"first_last_page\">";
          $pagingString .= "<a href=\"" . get_pagenum_link( $max_page ) . "\">" . $max_page . "</a>";
          $pagingString .= "</li>\n";
        }
      }
      if( $next_prev_text != "no" ){
        $pagingString .= self::wp_page_numbers_nextpage( $paged, $max_page, $nextpage) ;
      }
      $pagingString .= "</ul>\n";
      $pagingString .= "<div style='float: none; clear: both;'></div>\n";
      $pagingString .= "</div>\n";
      if( $max_page > 1 ) {
        echo $start . $pagingString . $end;
      }
    }
}