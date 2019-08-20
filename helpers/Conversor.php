<?php

require_once('OperacaoData.php');   

/**
 * Classe que contém métodos para converter dados de uma página HTML específica para JSON.
 * Página -> https://www.urionlinejudge.com.br/judge/en/profile/{usuarioId}
 */

class Conversor{

    private const URL = "https://www.urionlinejudge.com.br/judge/en/profile/";

    /**
     * Retorna URL completa de acordo com o ID informado
     */
    public static function getURLCompleta($usuarioId){
        return self::URL . $usuarioId;
    }

    /**
     * Retorna a estrutura DOM de uma página HTML
     */
    private static function getConteudoHTML($usuarioId){

        $url = self::getURLCompleta($usuarioId);

        if(self::isURLValida($url) == 1){
            $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
            $context = stream_context_create($opts);
            $html = file_get_contents(self::URL . $usuarioId, false, $context);
            return $html;
        }else{
            return false;
        }
    }

    private static function get_content($URL){
        $ch = curl_init();
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $URL);
          $data = curl_exec($ch);
          curl_close($ch);
          return $data;
    }

    /**
     * Verifica se a URL informada não irá retornar o código 500 (Internal Server Error) ou
     * 404 (URL não encontrada)
     */
    private static function isURLValida($url){
        $cabecalho = @get_headers($url);
        $existe = strpos($cabecalho[0],'500') || strpos($cabecalho[0],'404')  === false ? 1 : 0;
        return $existe;
    }

    /**
     * Retorna dados do aluno no formato array.
     */

    public static function getDadosAlunoArrayComOID($usuarioId){

        libxml_use_internal_errors(true);

        $dom = new DOMDocument();

        $html = self::getConteudoHTML($usuarioId);

        if($html){

            $dom->loadHTML($html);

            $divProfileBarEl = $dom->getElementById('profile-bar');
    
            $divProfileBarArrayEl = $divProfileBarEl->childNodes;
    
            $padrao = "@(\\n+) | \\s+@";
    
            $usuarioNome            = preg_replace($padrao, "", $divProfileBarArrayEl[5]->nodeValue);
            $usuarioPosicao         = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[1]->childNodes[2]->nodeValue);
            $usuarioInstituicao     = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[5]->childNodes[3]->nodeValue);
            $usuarioDesde           = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[7]->childNodes[2]->nodeValue);
            $usuarioScore           = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[9]->childNodes[2]->nodeValue);
            $usuarioResolvidos      = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[11]->childNodes[2]->nodeValue);
            $usuarioTentados        = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[13]->childNodes[2]->nodeValue);
            $usuarioSubmetidos      = preg_replace($padrao, "", $divProfileBarArrayEl[7]->childNodes[15]->childNodes[2]->nodeValue);
    
            $usuarioPosicao = substr($usuarioPosicao, 0, -2);

            $usuarioDesde = OperacaoData::converterDataUSAtoBR($usuarioDesde);

            return 
    
            [ 
                    'codigo' => $usuarioId,
                    'nome' => $usuarioNome, 
                    'posicao' => $usuarioPosicao, 
                    'instituicao' => $usuarioInstituicao, 
                    'desde' => $usuarioDesde, 
                    'score' => $usuarioScore, 
                    'resolvidos' => $usuarioResolvidos, 
                    'tentados' => $usuarioTentados, 
                    'submetidos' => $usuarioSubmetidos
            ];

        }else{
            return 0;
        }
    }

    /**
     * Retorna dados do aluno no formato JSON.
     */

    public function getDadosAlunoJSONComOID($usuarioId){

        $arr = self::getDadosAlunoArrayComOID($usuarioId);

        if($arr != 0){
            return 
            json_encode(
                $arr,
                JSON_UNESCAPED_SLASHES | 
                JSON_UNESCAPED_UNICODE | 
                JSON_PRETTY_PRINT
            );
        }else{
            return 0;
        }


    }

}