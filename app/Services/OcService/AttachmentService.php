<?php

namespace App\Services\OcService;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use DB;
use Storage;

class AttachmentService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    protected $disk = 'local';

    /**
     * 上传附件
     * @return [type] [description]
     */
    public function upload()
    {
        try {
            $exception = DB::transaction(function() {
                /*判断是否有文件*/
                if ( !request()->hasFile('file') ) {
                    throw new Exception(trans('code/attachment.upload.selectfile'), 2);
                }

                $file = request()->file('file');

                /*上传文件路径*/
                $path = $file->store('attachments', $this->disk);

                /*上传者信息*/
                $user = getUser();
                $userId = $user->id;
                $userName = $user->name;

                /*文件信息*/
                $name = $file->hashName();

                $data = [
                    'name' => $name,
                    'origin_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getClientSize(),
                    'path' => $path,
                    'file_ext' => $file->getClientOriginalExtension(),
                    'ext_info' => '',
                    'user_id' => $userId,
                    'user_name' => $userName,
                ];

                /*新增附件信息*/
                if( $attachment = $this->attachmentRepo->create($data) ) {

                    $this->results = array_merge($this->results, [
                        'data' => [
                            'id_hash' => $attachment->id_hash,
                            'name' => str_replace('.' . $attachment->file_ext, '', $attachment->origin_name),
                            'file_ext' => $attachment->file_ext,
                            'file_size' => calcFileSize($attachment->file_size),
                            'url' => route('admin.attachment.show', [$attachment->id_hash]),
                        ],
                    ]);
                } else {
                    throw new Exception(trans('code/attachment.upload.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/attachment.upload.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/attachment.upload.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }

    /**
     * 获取上传文件访问路径
     * @return [type] [description]
     */
    public function show($id)
    {
        try {
            /*解密*/
            $id = $this->attachmentRepo->decodeId($id);

            /*获取附件信息*/
            $attachment = $this->attachmentRepo->find($id);

            /*验证文件是否存在*/
            if( Storage::disk($this->disk)->exists($attachment->path) ) {
                /*获取文件*/
                return Storage::disk($this->disk)->path($attachment->path);
            } else {
                abort(404, '文件不存在');
            }
        } catch (Exception $e) {
            abort(404, '文件不存在');
        }
    }
}