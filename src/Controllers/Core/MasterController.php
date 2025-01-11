<?php

namespace Nozom\LandingPagePackage\Controllers\Core;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MasterController 
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected $Data = [];
    
    
    public function viewPage($pagePath){
        
        $thisUrl = url()->full();
        $ArUrl = $thisUrl;
        $EnUrl = $thisUrl;
        if(app()->getlocale() == 'en'){
            $EnUrl = $thisUrl;
            $ArUrl = str_replace('/en/', '/ar/', $thisUrl);
        }
        if(app()->getlocale() == 'ar'){
            $ArUrl = $thisUrl;
            $EnUrl = str_replace('/ar/', '/en/', $thisUrl);
        }
        View::share('EnUrl', $EnUrl);
        View::share('ArUrl', $ArUrl);
 
        return response()->view($pagePath,$this->Data);
    }

    public function getCurrentUrl(){
        $thisUrl = url()->current().'/';
        
        $arURL = str_replace('/en/', '/ar/', $thisUrl);
        
        if (app()->getlocale() == 'en') {
            $newUrl  = str_replace('/en/', '/ar/', $thisUrl);
        }else{
            $newUrl  = str_replace('/it/', '/en/', $thisUrl);
        }
        #View::share('newUrl', newUrl);
        view()->share('newUrl', $newUrl);
    }
    
    public function arrayPaginator($array, $request, $perPage,$counts)
    {
        $query = $request->query();
        $page = isset($query['page-number']) ? intval($query['page-number']) : 1;
        //$page = Input::get('page', 1);
        //$perPage = $perPage;
        $offset = ($page * $perPage) - $perPage;
       
        
        $paginator = new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            $counts,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query() , 'pageName' => 'page-number'   ]);
        
        /*
        $paginator = new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query() , 'pageName' => 'page-number'   ]);*/
        
        #$paginator->onEachSide = 1;
        //$paginator->slice(0, 10);
        /*$paginator->getUrlRange = function ($start, $end) use ($paginator) {
            $pages = [];
            
            for ($page = $start; $page <= $end && $page <= 10; $page++) {
                $pages[$page] = $paginator->url($page);
            }
            
            return $pages;
        };*/
        $paginator->window = 10;
        $paginator->onEachSide = 5;
        return $paginator;
        /*return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query() , 'pageName' => 'page-number' , 'fragment' => 'section-1', ]);*/
    }
    
   
    protected function setDate($date, $isSubMod = false){
        
        if ($date == '' or $date == null or $date == 'null' or $date == '0000-00-00' or $date == '00-00-0000' or  $date == '01-01-1900' or $date == '1900-01-01')
            return  $date =  0;
        
        if ($isSubMod) return  $date;

        if ($this->isValidTimeStamp($date)) {
            return date("d-m-Y", $date);
        } else {
            $dt = new \DateTime($date);
            return $dt->format('d-m-Y');
        }
    }
    
    protected function isValidTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
    
    
    
    public function unCompressData($data)
    {
        $data = hex2bin($data);
        if (empty($data)) return '';
        $uncompressed = gzuncompress($data);
        return $uncompressed;
    }
    
    public function images(Request $request){
        
        $Query = $request->query();
        
        $image = isset($Query['image']) ? intval($Query['image']) : 0;
        if ($image <= 0) die('');
        $image =  getXmlDir() . '/HelpImages/base64/' . $image ;
        if (!is_file($image)) die('');
        ob_get_clean();
        $img = file_get_contents($image);
        header("Content-type: image/jpeg");
        #echo base64_encode($img);
        echo $img;
        exit();
    }
     
}
