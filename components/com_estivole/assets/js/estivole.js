function deleteAvailibility(member_daytime_id)
{
	jQuery.ajax({
		url:'index.php?option=com_estivole&controller=member&task=member.deleteAvailibility',
		type:'POST',
		data: 'member_daytime_id='+member_daytime_id,
		dataType: 'JSON',
		success:function(data)
		{
			if(data.success)
			{
				
			} else {
				alert('ko');
			}
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}

function getDaytimesByService(calendar_id, service_id)
{
	jQuery.ajax({
		url:'index.php?option=com_estivole&controller=daytime&task=daytime.getDaytimesByService&tmpl=component',
		type:'POST',
		data: 'calendar_id='+calendar_id+'&service_id='+service_id,
		dataType:'JSON',
		success:function(data)
		{
			jQuery("#addDayTimeForm #jformdaytime").empty();
			jQuery("#addDayTimeForm #jformdaytime").trigger('liszt:updated');
			jQuery.each(data, function(index, item) {
				jQuery("#addDayTimeForm #jformdaytime").append(jQuery('<option></option>').val(item.daytime_day).text(item.daytime_day));
			});
			jQuery("#addDayTimeForm #jformdaytime").trigger('liszt:updated');
			
			var daytime = jQuery("#addDayTimeForm #jformdaytime").chosen().val();
			var service_id = jQuery("#addDayTimeForm #jformservice_id").chosen().val();
			var calendar_id = jQuery("#addDayTimeForm #calendar_id").val();
			getCalendarDaytimes(calendar_id, daytime, service_id);
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}

function getCalendarDaytimes(calendar_id, daytime, service_id)
{
	var member_id = jQuery("#addDayTimeForm #member_id").val();

	jQuery.ajax({
		url:'index.php?option=com_estivole&controller=member&view=member&layout=_availibilitytable&format=raw&tmpl=component',
		type:'POST',
		data: 'calendar_id='+calendar_id+'&daytime='+daytime+'&service_id='+service_id+'&member_id='+member_id,
		success:function(data)
		{
			var el = jQuery("#addDayTimeForm #availibilityTableDiv");
			el.html(data);
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}