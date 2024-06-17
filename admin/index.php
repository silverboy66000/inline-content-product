<?php
global $wpdb;
$table_name = $wpdb->prefix . 'noyan_audit_list';
$table_name_token = $wpdb->prefix . 'noyan_crm_settings';

$exampleListTable = new List_Table();
$exampleListTable->prepare_items();
$http = _wp_http_get_object();
$siteUrl = get_option( 'siteurl' );

//---- start get last token form DB
do_action('crmAccessToken');
$table_name_token = $wpdb->prefix . 'noyan_crm_settings';
$sqlToken = "SELECT * FROM  $table_name_token LIMIT 1";
$resultsToken = $wpdb->get_results($sqlToken);
$accessToken = $resultsToken[0]->access_token;
//----- end get last token form DB


?>

    <div class="wrap">
        <div id="icon-users" class="icon32"></div>
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php
		$exampleListTable->search_box('جستجو', 'search_id');

		$exampleListTable->display();
		?>

    </div>

<?php

if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_Table extends WP_List_Table
{

	public function prepare_items()
	{
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();

		$data = $this->table_data();
		usort( $data, array( &$this, 'sort_data' ) );

		$perPage = 25;
		$currentPage = $this->get_pagenum();
		$totalItems = count($data);

		$this->set_pagination_args( array(
			'total_items' => $totalItems,
			'per_page'    => $perPage
		) );

		$data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $data;
	}

	public function get_columns()
	{
		$columns = array(
			'id'        => 'id',
			'auditid'        => 'audi ID',
			'action_Display'        => ' عملیات',
			'objectid_value_Display'        => 'عنوان',
			'status'       => 'وضعیت',
			'createdon_value_Display'       => 'تاریخ ایجاد',
			'date'       => 'تاریخ دریافت',
		);

		return $columns;
	}

	public function get_hidden_columns()
	{
		return array();
	}

	public function get_sortable_columns()
	{
		return array(
			'id' => array('id', false),
			'auditid' => array('auditid', false),
			'action_Display' => array('action_Display', false),
			'objectid_value_Display' => array('objectid_value_Display', false),
			'status' => array('status', false),
			'createdon_value_Display' => array('createdon_value_Display', false),
			'date' => array('date', false),
		);
	}

	private function table_data()
	{
		$data = array();
		global $wpdb;

		$table_name = $wpdb->prefix . 'noyan_audit_list';
		$sql = "SELECT * FROM  $table_name ORDER BY id DESC";
		$results = $wpdb->get_results($sql);
		if (count($results) > 0) {
			foreach ($results as $res) {
				$data[] = array(
					'id'          => $res->id,
					'auditid'          => $res->auditid,
					'action_Display'          => $res->action_Display,
					'objectid_value_Display'          => $res->objectid_value_Display,
					'status'    => $res->status,
					'createdon_value_Display'        => $res->createdon_value_Display,
					'date'     => $res->date,
				);
			}
		}

		return $data;
	}


	function get_userdata( $user_id ) {

		// return get_user_meta($user_id)['first_name'][0].' '.get_user_meta($user_id)['last_name'][0];
		return 1;
	}
	function column_title($item) {

//        if ($item=='outofstock')
//        {
//            return 'ناموجود شده';
//        }
//        else
//        {
//            return 'موجود درانبار';
//        }
	}
	function column_product($item)
	{
		//$product = wc_get_product( $item );
		// return $product->get_title();
		return 1;
	}
	public function column_default( $item, $column_name )
	{
		switch( $column_name ) {
			case 'id':
			case 'auditid':
			case 'action_Display':
			case 'objectid_value_Display':
			case 'status':
			case 'createdon_value_Display':
			case 'date':
				return $item[ $column_name ];

			default:
				return print_r( $item, true ) ;
		}
	}

	private function sort_data( $a, $b )
	{
		// Set defaults
		$orderby = 'date';
		$order = 'desc';

		// If orderby is set, use this as the sort column
		if(!empty($_GET['orderby']))
		{
			$orderby = $_GET['orderby'];
		}

		// If order is set use this as the order
		if(!empty($_GET['order']))
		{
			$order = $_GET['order'];
		}


		$result = strcmp( $a[$orderby], $b[$orderby] );

		if($order === 'asc')
		{
			return $result;
		}

		return -$result;
	}
}
?>