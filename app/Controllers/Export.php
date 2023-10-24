<?php

namespace App\Controllers;
use App\Models\Export\ExportModel;

use App\Libraries\Emails\EmailsUser;


class Export extends BaseController
{
    public function index()
    {
		$data_head['title_html'] = 'Export - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('export/export').
                view('footer');    
    }

    public function sendemail()
    {
        $ExportModel = new ExportModel();

        $words_user = $ExportModel->getWords();
        $sentences_user = $ExportModel->getSentences();
        $email_user = $ExportModel->getEmailUser();

        $words_table = '<tr style="background-color: white;">
        <th style="background-color: white;">English</th>
        <th style="background-color: white;">Native</th>
        <th style="background-color: white;">Description</th>';

        $number_color = 1;
        foreach ($words_user as $words) {

            if($number_color&1) {
                $css_td = '#f4f2f2;';
            } else {
                $css_td = '#e0e2f1';
            }

            $words_table .= '
            <tr style="background-color: '.$css_td.'">
            <td style="background-color: '.$css_td.'width: 35%;">' . $words['english_word'] . '</td>
            <td style="background-color: '.$css_td.'width: 35%;">' . $words['native_word'] . '</td>
            <td style="background-color: '.$css_td.'width: 30%;">' . $words['description'] . '</td>
            </tr>';

            $number_color++;
        }

        $sentences_table = '<tr style="background-color: white;">
        <th style="background-color: white;">English</th>
        <th style="background-color: white;">Native</th>';
        $number_color = 1;

        foreach ($sentences_user as $sentence) {

            if($number_color&1) {
                $css_td = '#f4f2f2;';
            } else {
                $css_td = '#e0e2f1';
            }

            $sentences_table .= '
            <tr style="background-color: '.$css_td.'">
            <td style="background-color: '.$css_td.'">' . $sentence['english_sentence'] . '</td>
            <td style="background-color: '.$css_td.'">' . $sentence['native_sentence'] . '</td>
            </tr>';
            $number_color++;

        }

        $EmailsUser = new EmailsUser();
        $EmailsUser->email_export($email_user, $words_table, $sentences_table);

		$data_head['title_html'] = 'Send! - Improve English Vocabulary';

        return  view('head', $data_head).
                view('navbar').
                view('export/send_email').
                view('footer');    

    }

}