<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RajaOngkir extends CI_Controller
{
    private $apiKey = "your apikey";

    public function provinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->apiKey"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $array_response = json_decode($response, true);
            // echo '<pre>';
            // print_r($array_response["rajaongkir"]["results"]);
            // echo '</pre>';

            $data_provinsi = $array_response["rajaongkir"]["results"];
            echo "<option>Pilih Provinsi</option>";
            foreach ($data_provinsi as $value) {
                echo "<option value='" . $value['province'] . "' id_provinsi='" . $value['province_id'] . "'>" . $value['province'] . "</option>";
            }
        }
    }

    public function kota()
    {
        $id_provinsi = $this->input->post('id_provinsi');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->apiKey"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $data_kota = $array_response["rajaongkir"]["results"];
            echo "<option>Pilih Kota</option>";
            foreach ($data_kota as $value) {
                // echo "<option value='" . $value['city_id'] . "'>" . $value['city_name'], $value['city_id'] . "</option>";
                echo "<option value='" . $value['city_name'] . "' id_kota='" . $value['city_id'] . "'>" . $value['city_name'] . "</option>";
            }
        }
    }

    public function ekspedisi()
    {
        echo '<option>Pilih Ekspedisi</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">TIKI</option>';
        echo '<option value="pos">POS Indonesia</option>';
    }

    public function paket()
    {
        $ekpedisi = $this->input->post('ekspedisi');
        $id_kota = $this->input->post('id_kota');
        $berat = $this->input->post('berat');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=79&destination=" . $id_kota . "&weight=" . $berat . "&courier=" . $ekpedisi,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->apiKey"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response, true);
            $data_paket = $array_response["rajaongkir"]["results"][0]["costs"];
            echo "<option value='null'>Pilih Paket</option>";

            foreach ($data_paket as $value) {
                echo "<option value='" . $value['service'] . "' ongkir='" . $value['cost'][0]['value'] . "'>" . $value['service'] . " | Rp " . $value['cost'][0]["value"] . " | " . $value['cost'][0]["etd"] . " Hari" . "</option>";
            }
        }
    }
}
