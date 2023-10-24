<?php

function localJS($name_file)
{
    $value = '';

    if ($_SERVER['SERVER_NAME'] == LOCALSERVER) {
        $value = 'js/' . $name_file;
    } else {
        $value = 'compressed/js/' . $name_file . '.min';
    }

    return $value;
}

function isLoggedBool()
{
    if(session()->get('id_user') != '' && session()->get('user_status') == '1')
    {
        return TRUE;
    } else {
        return FALSE;
    }
}

function isLoggedReturn()
{
    if(session()->get('id_user') != '' && session()->get('user_status') == '1')
    {
        return redirect()->to(base_url());
    }
}

function get_hidden_id($str)
{
    $numbers = array(0,1,2,3,4,5,6,7,8,9);

    $number_words = array('qa', 'wt', 'eb', 'ns', 'dm', 'io', 'rd', 'gh', 'kl', 'zc');
    
    $new_string = str_replace($numbers, $number_words, $str);

    return $new_string;
}

function get_show_id($str)
{
    $numbers = array(0,1,2,3,4,5,6,7,8,9);

    $number_words = array('qa', 'wt', 'eb', 'ns', 'dm', 'io', 'rd', 'gh', 'kl', 'zc');

    $new_string = str_replace($number_words, $numbers, $str);

    return $new_string;
}

function get_native_language_db()
{
    $db = \Config\Database::connect();

    $builder = $db->table('native_language nl');
    $builder->select('nl.id, nl.native_language');

    $query = $builder->get()->getResultArray();

    return $query;
}

function pagination($get_url, int $num_page, int $initial_number, int $number_condition_limit, int $total_pages, string $url_pagination)
{
    if(!is_null($get_url))
    {
        if(substr($get_url, 0, 1) != '&')
        {
            $get_url = '&'.$get_url;
        }
    }

    $pagination = '
        <nav aria-label="Page navigation example">
            <ul class="pagination">';

            if ($num_page != 1) {
                $last_page = $num_page - 1;
                
                $pagination .= '
                <li class="page-item first-page">
                    <a class="page-link" href="'.base_url().'/'.$url_pagination.'?page=1'.$get_url.'" title="First Page '.$total_pages.'">First Page</a>
                </li>
                <li class="page-item previous-page">
                    <a class="page-link" href="'.base_url().'/'.$url_pagination.'?page='.$last_page.$get_url.'" title="Previous Page '.$last_page.'">Previous Page</a>
                </li>';

            }


            for ($x = $initial_number; $x < $number_condition_limit; $x++) {

                if (($x > 0) && ($x <= $total_pages)) {

                    if ($x == $num_page) {
                        $pagination .= '
                        <li class="page-item active"><span class="page-link">'.$x.'</span></li>';
                    } else {
                        $pagination .= '
                        <li class="page-item"><a class="page-link" href="'.base_url().'/'.$url_pagination.'?page='.$x.$get_url.'">'.$x.'</a></li>';
                    }
                }
            }


            if ($num_page < $total_pages) {
                $next_page = $num_page + 1;
                $pagination .= '
                <li class="page-item next-page">
                    <a class="page-link" href="'.base_url().'/'.$url_pagination.'?page='.$next_page.$get_url.'" title="Next Page '.$next_page.'">Next Page</a>
                </li>
                <li class="page-item last-page">
                    <a class="page-link" href="'.base_url().'/'.$url_pagination.'?page='.$total_pages.$get_url.'" title="Last Page '.$total_pages.'">Last Page</a>
                </li>';
            }

            $pagination .= '
            </ul>
        </nav>';

    return $pagination;
}


function selected_voice()
{
    $db = \Config\Database::connect();

    $builder = $db->table('user u');
    $builder->select('u.user_voice_selected');
    $builder->where('u.id', session()->get('id_user'));

    $query = $builder->get();

    return $query->getResult()[0]->user_voice_selected;    
}

function categories_user()
{
    $db = \Config\Database::connect();

    $builder = $db->table('categories ca');
    $builder->select('ca.id, ca.category');
    $builder->where('ca.id_user', session()->get('id_user'));
    
    $query = $builder->get()->getResultArray();

    return $query;
}