<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Session;

class Items extends Model
{
    /**
     * Field to be mass-assigned.
     *
     * @var array
     */
    protected $fillable = ['value', 'computer_id', 'is_checked'];

    /**
     *
     * Set computer id
     *
     */

    public static function  setId() {
        if (Session::get('computer_id') === null){
            $computer_id = 0;
            while(true){
                $computer_id = rand(100, 100000);
                if(!Items::where('computer_id', $computer_id)->exists()) break;
            }
            Session::put(['computer_id' => $computer_id ]);
        }
    }

    /**
     * Change status of item
     *
     * @return bool
     */

    public function  checked() {
        return $this->update(['is_checked' => !$this->is_checked]);
    }
}
