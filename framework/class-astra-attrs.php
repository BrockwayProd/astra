<?php
/**
 * Astra Attrs
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2017, Astra
 * @link        http://wpastra.com/
 * @since       Astra 1.0.20
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Attrs' ) ) {

	/**
	 * Astra Attrs
	 */
	class Astra_Attrs {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function __construct() {
			$this->init();
		}

		public function init() {
			add_filter( 'astra_attr_article', array( $this, 'article_attrs' ) );
			add_filter( 'astra_attr_sidebar', array( $this, 'sidebar_attrs' ) );
			add_filter( 'astra_attr_footer', array( $this, 'footer_attrs' ) );
			add_filter( 'astra_attr_header', array( $this, 'header_attrs' ) );
			add_filter( 'astra_attr_post-meta-author-url', array( $this, 'post_meta_author_url_attrs' ) );
			add_filter( 'astra_attr_site-identity-url', array( $this, 'site_identity_url_attrs' ) );
			add_filter( 'astra_attr_site-navigation', array( $this, 'site_navigation_attrs' ) );
		}

		public function article_attrs( $attrs ) {

			$attrs['id'] = 'post-' . get_the_ID();
			return $attrs;
		}

		public function sidebar_attrs( $attrs ) {

			$attrs['id']   = 'secondary';
			$attrs['role'] = 'complementary';
			return $attrs;
		}

		public function footer_attrs( $attrs ) {

			$attrs['id']   = 'colophon';
			$attrs['role'] = 'contentinfo';
			return $attrs;
		}

		public function header_attrs( $attrs ) {

			$attrs['id']   = 'masthead';
			$attrs['role'] = 'banner';
			return $attrs;
		}

		public function post_meta_author_url_attrs( $attrs ) {

			/* translators: 1. %s: author */
			$attrs['title'] = sprintf( __( 'View all posts by %s', 'astra' ), get_the_author() );
			$attrs['href']  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$attrs['rel']   = 'author';
			return $attrs;
		}

		public function site_identity_url_attrs( $attrs ) {

			$attrs['href'] = esc_url( home_url( '/' ) );
			$attrs['rel']  = 'home';
			return $attrs;
		}

		public function site_navigation_attrs( $attrs ) {

			$attrs['id']         = 'site-navigation';
			$attrs['role']       = 'navigation';
			$attrs['aria-label'] = __( 'Site Navigation', 'astra' );
			return $attrs;
		}
	}

	Astra_Attrs::get_instance();

}// End if().
