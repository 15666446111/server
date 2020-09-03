<?php
namespace App\Admin\Actions\Form;

use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Str;
use Dcat\Admin\Models\Administrator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportMcc extends Form
{
    public function handle(array $input)
    {
        $file = storage_path('app/public/uploads/'.$input['file']);

        try {
            $result = Excel::toArray(null, $file);

            // 只取第一个Sheet
            if (count($result[1]) > 0) 
            {
                $rows = $result[1];

                $headings = [];

                if (count($rows) > 0) {
                    
                    foreach ($rows[0] as $key => $col){
                        $headings[Str::snake($col)] = $key;
                    } 
                    
                }

                $data = [];

                foreach ($rows as $key => $row) 
                {
                    if ( $key > 0 && isset($row[$headings['m_c_c']]) ) 
                        $data[] = array('mcc' => $row[$headings['m_c_c']], 'explain' => $row[$headings['解释']], 'type' =>  2);
                }
                
                foreach ($data as $key => $value) {
                    \App\Mcc::firstOrCreate($value);
                }

                
                

            }

        } catch (ValidationException $validationException) {
            return Response::withException($validationException);
        } catch (Throwable $throwable) {
            $this->response()->status = false;
            // return $this->response()->swal()->error($throwable->getMessage());
            return $this->response()->error('上传失败')->refresh();
        }
    }

    public function form()
    {
        $this->file('file', '上传表格（Excel）');
    }

}
