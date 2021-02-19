<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sow;
use App\Models\SowMaster;
use App\Models\Transaction;
use App\Models\FileUploadRevision;

class FileUploadController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:sow-upload');
    }
    
    /*

     * @return \Illuminate\Http\Response

     */
    public function fileUpload() {
        $filter = request()->filter;
        $sow = Sow::find(request()->sow_id);

        
        if($this->checkFileExistsForSow(request()->sow_id))
            return back()->with('success', 'Please download already uploaded SOW');
        return view('sows.fileUpload',compact('filter','sow'));
    }
    
    /*

     * @return \Illuminate\Http\Response

     */
    public function fileUploadPost() {
        try {
            request()->validate([
                'uploaded_file' => 'required|mimes:pdf|max:4096',
                'sow_id' => 'required',
                'filter' => 'required'
            ]);

            $fileName = "signed_sow_" . request()->sow_id . "_" . time() . "." . request()->uploaded_file->getClientOriginalExtension();
            
            
            $id = request()->sow_id;
            $filter = request()->filter;
            if(Storage::disk('signed_sows')->put($fileName, file_get_contents(request()->uploaded_file->getRealPath()))) {
                request()->request->add(['file_name' => $fileName]); //add request
                $stored = $this->store(request());
            }
            if($stored)
                return redirect()->route('sowView', compact('filter', 'id'));
        } catch (Exception $ex) {
            print_r($ex);
            die();
        }
    }
    
    public function checkFileExistsForSow(int $sowId=0): bool {
        if($sowId === 0)
            return FALSE;
        
        $exists = FALSE;
        $exists = (FileUploadRevision::where('sow_id', $sowId)->count() >= 1)?TRUE:FALSE;
        return $exists;
    }
    
    public function deleteFile() {
        $filter = request()->filter;
        $id = request()->sow_id;
        if(FileUploadRevision::where('sow_id', $id)->delete())
            return redirect()->route('sowView', compact('filter', 'id'));
    }
    
    public function getUploadedSignedSow (int $sowId=0) {
        if($sowId === 0)
            return FALSE;
        
        foreach (\File::files(storage_path() . '\app\public\signed_sows') as $key => $file) {
            if(preg_match("/signed_sow_" . $sowId . "_/", $file->getFileName())) {
                $fileNameArr = explode('_', $file->getFileName());
                $timeStampWithExt = $fileNameArr[count($fileNameArr) - 1];
                $timeStamps[$key] = explode('.', $timeStampWithExt)[0];
            }
        }
        $maxTimeStamp = max($timeStamps);
        $keyOfMaxTimeStamp = array_search($maxTimeStamp, $timeStamps);
        $pathToDownloadFile = \File::files(storage_path() . '\app\public\signed_sows')[$keyOfMaxTimeStamp]->getPathName();
        $nameOfFile = \File::files(storage_path() . '\app\public\signed_sows')[$keyOfMaxTimeStamp]->getFileName();
        return response()->download($pathToDownloadFile, $nameOfFile, ["Content-type:application/pdf"]);
    }

    public function store(Request $request): bool {
        $storedData = FileUploadRevision::create($request->all());
        return (empty($storedData->toArray()))?FALSE:TRUE;
    }
    
    
}
