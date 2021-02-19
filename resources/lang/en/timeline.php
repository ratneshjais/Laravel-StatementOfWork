<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'badge' => [
    'draft' => 'primary',
    'sent_to_reviewer' => 'info',
    'sent_to_approver' => 'success',
    'rejected_by_reviewer' => 'danger',
    'rejected_by_approver' => 'danger',
    'approved_by_approver' => 'success',
    'deleted' => 'Deleted'],

    'icon' => [
    'draft' => 'fa fa-plus',
    'sent_to_reviewer' => 'fa fa-file-export',
    'sent_to_approver' => 'fa fa-check-square',
    'rejected_by_reviewer' => 'fa fa-times-circle',
    'rejected_by_approver' => 'fa fa-times-circle',
    'approved_by_approver' => 'fa fa-thumbs-up',
    'deleted' => 'Deleted'],

    'string' => [
    'draft' => ':creator created sow.',
    'sent_to_reviewer' => ':creator sent sow for review.',
    'sent_to_approver' => ':creator sent sow for approval.',
    'rejected_by_reviewer' => ':creator rejected sow.',
    'rejected_by_approver' => ':creator rejected sow.',
    'approved_by_approver' => ':creator approved sow.',
    'deleted' => 'Deleted.']
];


/* Transalation for status to timeline class */
    