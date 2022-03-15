<?php
/**
 * Snippet Name: Filter by Template
 * Desc: Filter post/page list table in admin dashboard
 * 
 */


class FilterPagesByTemplate {
	
	public function __construct()
	{
		add_action( 'restrict_manage_posts', array( $this, 'filter_dropdown' ) );
		add_filter( 'request', array( $this, 'filter_post_list' ) );
		
		add_filter('manage_pages_columns', array( $this, 'post_list_columns_head'));
		add_action('manage_pages_custom_column', array( $this, 'post_list_columns_content' ), 10, 2);

	}
	
	public function filter_dropdown()
	{
		if ( $GLOBALS['pagenow'] === 'upload.php' ) {
			return;
		}
	
		$template = isset( $_GET['page_template_filter'] ) ? $_GET['page_template_filter'] : "all"; 
		$default_title = apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'meta-box' );
		?>
		<select name="page_template_filter" id="page_template_filter">
			<option value="all">All Page Templates</option>
			<option value="all_missing" style="color:red" <?php echo ( $template == 'all_missing' )? ' selected="selected" ' : "";?>>All Missing Page Templates</option>
			<option value="default" <?php echo ( $template == 'default' )? ' selected="selected" ' : "";?>><?php echo esc_html( $default_title ); ?></option>
			<?php page_template_dropdown($template, 'post'); ?>
            <?php page_template_dropdown($template, 'page'); ?>
		</select>
		<?php	
	}//end func 
	
	public function filter_post_list( $vars ){

		if ( ! isset( $_GET['page_template_filter'] ) ) return $vars;
		$template = trim($_GET['page_template_filter']);

		$data = get_option("filter_page_by_template_data", array() );
		$filter_used = isset( $data['filter_used'] ) ? intval( $data['filter_used'] ) : 0;
		$filter_used ++;
	    $data['filter_used'] = $filter_used;
	    update_option("filter_page_by_template_data", $data );

		if ( $template == "" || $template == 'all' ) return $vars;
		
		if( $template == 'all_missing')
		{
			$templates = wp_get_theme()->get_page_templates( null, 'page' );
			$template_files = array_keys($templates);
			$template_files[] = 'default';
			$vars = array_merge(
				$vars,
				array(
					'meta_query' => array(
						array(
							'key'     => '_wp_page_template',
							'value'   => $template_files,
							'compare' => 'NOT IN',
						)
					),
				)
			);
		}
		else
		{
			$vars = array_merge(
				$vars,
				array(
					'meta_query' => array(
						array(
							'key'     => '_wp_page_template',
							'value'   => $template,
							'compare' => '=',
						),
					),
				)
			);
		}

		return $vars;
	
	}//end func

	# Add new column to post list
	public function post_list_columns_head( $columns )
	{
	    $columns['template'] = 'Template';
	    return $columns;
	}
	 
	#post list column content
	public function post_list_columns_content( $column_name, $post_id )
	{
	    $post_type = 'page';

	    if($column_name == 'template')
	    {
	        $template = get_post_meta($post_id, "_wp_page_template" , true );
	        if($template)
	        {
	        	if($template == 'default')
	        	{
	        		$template_name = apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'meta-box' );
	        		echo '<span title="Template file : page.php">'.$template_name.'</span>';
	        	}
	        	else
	        	{
	        		$templates = wp_get_theme()->get_page_templates( null, $post_type );

	        		if( isset( $templates[ $template ] ) )
	        		{
	        			echo '<span title="Template file : '.$template.'">'.$templates[ $template ].'</span>';
	        		}
	        		else
	        		{
	        			
	        			echo '<span style="color:red" title="This template file does not exist">'.$template.'</span>';
	        		}
	        	}
	            
	        }
	    }
	}
	
	
}//end class

if( is_admin() )
{
   new FilterPagesByTemplate();
}