<?php

class Compteur{

    public $file_path;

    public function __construct(string $file_path)
    {
        $this->$file_path = $file_path;
    }   
    
    public function increment(): void 
    {
        $counter = 1;
        if (file_exists($this->$file_path)){
            $counter = (int)file_get_contents($this->$file_path);
            $counter++;
        }
        file_put_contents($this->$file_path, $counter);
    } 

    public function get_count(): int
    {      
        if (file_exists($this->$file_path)){
            return 0;
        }  
        return file_get_contents($this->$file_path);   
    }      
    
    /* public function view_number_per_month(int $year, int $month): int{
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $year . '-' . $month . '-' . '*';
        $files = glob($file);
        $total = 0;
        foreach($files as $file){
            $total += (int)file_get_contents($file);
            
        }return $total;
    } */
    
    /* public function view_number_per_month_detailed(int $year, int $month): array{
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $year . '-' . $month . '-' . '*';
        $files = glob($file);
        $views = [];
        foreach($files as $file){
            $parts = explode('-', basename($file));
            $views[] = [
                'year' => $parts[1],
                'month' => $parts[2],
                'day' => $parts[3],
                'visits' => file_get_contents($file)
            ];
        }
        return $views;
    } */

    /* public static function add_view(): void {
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
        $day_file = $file . '-' . date('Y-m-d');
        counter_increment($file);
        counter_increment($day_file);
    } */
}