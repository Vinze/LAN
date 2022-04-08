<?php
namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Image;

class Upload extends Model {

    protected $connection = 'mysql_inventory';

    protected $table = 'inventory_freez_it.uploads';

    protected $fillable = [
        'linkage_type',
        'linkage_id',
        'filename',
        'filepath',
        'filesize',
        'filetype',
    ];

    public function linkage() {
        return $this->morphTo();
    }

    public function getUrlAttribute() {
        return url('uploads/'.$this->uid.'/'.$this->filename);
    }

    public function storeAndSave($file) {
        $storage = Storage::disk('nfs');

        if ($this->exists && $storage->exists($this->filepath)) {
            $storage->delete($this->filepath);
        }

        $this->filename = $file->getClientOriginalName();
        $this->filetype = $file->getClientMimeType();

        if (str_contains($this->filetype, 'image')) {
            $this->filepath = 'uploads/'.Str::random(40).'.'.$file->extension();

            $image = Image::make($file)
                ->resize(1920, 1920, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->orientate()
                ->save($storage->path($this->filepath));

            $this->filesize = $image->filesize();
        } else {
            $this->filepath = $file->store('uploads', 'nfs');
            $this->filesize = $file->getSize();
        }

        $this->save();

        return $this;
    }

    public static function booted() {
        static::creating(function($upload) {
            if ( ! $upload->uid) {
                $upload->uid = Str::random(28);
            }
        });

        static::deleting(function($upload) {
            if (Storage::disk('inventory')->exists($upload->filepath)) {
                Storage::disk('inventory')->delete($upload->filepath);
            }
        });
    }

}