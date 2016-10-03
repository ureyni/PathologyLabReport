<?php

/**
 * Description of ConfigClass
 * if admin config values saved to database , reset config value.
 * @author hucak
 */
class ConfigClass {
    
    function Configfunction() {
        $CI =&get_instance();
        $query = $CI->db->get_where('settings');
        foreach($query->result() as $row)
                $CI->config->set_item($row->modul_field, $row->modul_value);
    }

}
