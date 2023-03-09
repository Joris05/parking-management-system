<?php 

class Model_dashboard extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_total_per_vehicle()
    {
        $this->db->select('vehicle_cat_id, COUNT(vehicle_cat_id) as total_vehicle');
        $this->db->where('paid_status', 1);
        $this->db->group_by('vehicle_cat_id'); 
        $query = $this->db->get('parking'); 
        $result = $query->result_array();
        return $result;
    }

    public function get_parking_year()
    {
        $this->db->select('*');
        $this->db->where('paid_status', 1);
        $query = $this->db->get('parking'); 
        $result = $query->result_array();

        $return_data = array();
		foreach ($result as $k => $v) {
			$date = date('Y', $v['in_time']);
			$return_data[] = $date;
		}

		$return_data = array_unique($return_data);

		return $return_data;
    }

    public function get_parking_data_year($year)
    {
        $months = $this->months();
			
        $this->db->select('*');
        $this->db->where('paid_status', 1);
        $query = $this->db->get('parking'); 
        $result = $query->result_array();

        $final_data = array();
        foreach ($months as $month_k => $month_y) {
            $get_mon_year = $year.'-'.$month_y;	

            $final_data[$get_mon_year][] = '';
            foreach ($result as $k => $v) {
                $month_year = date('Y-m', $v['in_time']);

                if($get_mon_year == $month_year) {
                    $final_data[$get_mon_year][] = $v;
                }
            }
        }	


        return $final_data;
    }

    private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}
}