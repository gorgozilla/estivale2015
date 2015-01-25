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
				alert('ok');
			} else {
				alert('ko');
			}
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}


function getCalendarDaytimes(calendar_id, daytime, service_id)
{
	jQuery.ajax({
		url:'index.php?option=com_estivole&controller=member&view=member&layout=_availibilitytable&format=raw&tmpl=component',
		type:'POST',
		data: 'calendar_id='+calendar_id+'&daytime='+daytime+'&service_id='+service_id,
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