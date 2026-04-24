<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index() {
        $transfers = $this->getTransfer();
        confirmDelete('Are you sure you want to delete this transfer?');
        return(view('pages.transaction.transfer', ['title' => 'Transfer'], compact('transfers')));
    }

    public function getTransfer(){
        return [
            (object) [
                'id' => 1,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ],
            (object) [
                'id' => 2,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ],
            (object) [
                'id' => 3,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ],
            (object) [
                'id' => 4,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ],
            (object) [
                'id' => 5,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ],
            (object) [
                'id' => 6,
                'date' => '01-06-2025',
                'amount' => 5000000,
                'from_account' => 'BCA',
                'to_account' => 'BLU',
                'description' => 'pindah dana'
            ] 
        ];
    }
}
