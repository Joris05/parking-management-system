<?php 

class Model_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function get_parking_data_per_year($year)
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