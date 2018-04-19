@foreach($parts as $part)

<?php 

if (isset($old_parts) && $old_parts != NULL)
{
	if (in_array($part->id, @$old_parts))
	{
		$check = True;
	}
	else
	{
		$check = False;
	}
}
else
{
	$check = False;
}



?>
<div class="col-md-4">
	<input type="checkbox" name="part_id[]" <?=($check == True) ? 'checked':'';?> 
	 value="{{ $part->id }}">&nbsp;&nbsp;{{  $part->name }}
</div>	


@endforeach

