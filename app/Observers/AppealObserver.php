<?php

namespace App\Observers;

use App\Models\Appeal;
use App\Models\AppealStatusLog;

class AppealObserver
{
    public function updating(Appeal $appeal): void
    {
        if ($appeal->isDirty('status')) {
            AppealStatusLog::create([
                'appeal_id'   => $appeal->id,
                'user_id'     => auth()->id(),
                'from_status' => $appeal->getOriginal('status'),
                'to_status'   => $appeal->status,
                'changed_at'  => now(),
            ]);
        }
    }
}
