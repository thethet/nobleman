Hi {{ $username }},<br><br>

{{ Auth::user()->first_name." ".Auth::user()->last_name }} has applied for leave from {{ $start_date." ".$period_start }} 
@if ($end_date != "")
to {{ $end_date." ".$period_end }}
@endif
<br>Please go to the following link to approve / disapprove.<br>
<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/leaves/".$id; ?>"><?php echo base_path()."/leaves/".$id; ?></a><br><br><br>
Regards,<br>
Innov8te HRM

