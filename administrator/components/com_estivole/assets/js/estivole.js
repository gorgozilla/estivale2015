function addDayTimeModal(daytime_id, service_id, start_hour, end_hour, quota)
{
	jQuery("#addDayTimeModal").modal('show');

	if(daytime_id==''){
		jQuery("#addDayTimeModal #daytime_id").val('');	
		jQuery("#addDayTimeModal #quota").val('');	
	}else{
		jQuery("#addDayTimeModal #daytime_id").val(daytime_id);
	}
	jQuery("#addDayTimeModal #quota").val(quota);
	jQuery("#addDayTimeModal #jformdaytime_hour_end").attr('value', end_hour);
	jQuery("#addDayTimeModal #jformdaytime_hour_end").trigger("liszt:updated");
	jQuery("#addDayTimeModal #jformdaytime_hour_start").attr('value', start_hour);
	jQuery("#addDayTimeModal #jformdaytime_hour_start").trigger("liszt:updated");
	jQuery("#addDayTimeModal #jformservice_id").attr('value', service_id);
	jQuery("#addDayTimeModal #jformservice_id").trigger("liszt:updated");
}

function addAvailibilityModal(member_id, member_daytime_id)
{
	jQuery("#addAvailibilityModal").modal('show');
	jQuery("#addAvailibilityModal #member_id").val(member_id);
	jQuery("#addAvailibilityModal #member_daytime_id").val(member_daytime_id);
	var calendar_id = jQuery("#calendar_selector").val();
	getCalendarDates(calendar_id);
	jQuery("#jformdaytime").chosen().change( function(){
		var daytime = jQuery(this).val();
		var service_id = jQuery("#jformservice_id").val();
		getCalendarDaytimes(calendar_id, daytime, service_id);
	});
	jQuery("#jformservice_id").chosen().change( function(){
		var service_id = jQuery(this).val();
		var daytime = jQuery("#jformdaytime").val();
		getCalendarDaytimes(calendar_id, daytime, service_id);
	});
}

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

function getCalendarDates(calendar_id)
{
	jQuery.ajax({
		url:'index.php?option=com_estivole&task=getCalendarDates&format=raw',
		type:'POST',
		data: 'calendar_id='+calendar_id,
		dataType: 'JSON',
		success:function(data)
		{
			if(data.success)
			{
				var el = jQuery("#addAvailibilityModal #jformdaytime");
				el.empty(); // remove old options
				for(i=0;i<data.calendar_dates.length;i++){
					el.append(jQuery("<option></option>").attr("value", data.calendar_dates[i].daytime_id).text(data.calendar_dates[i].daytime_day));
				}
				jQuery("#addAvailibilityModal #jformdaytime").trigger("liszt:updated");
				var service_id = jQuery("#jformservice_id").chosen().val();
				var daytime = jQuery("#jformdaytime").val();
				getCalendarDaytimes(calendar_id, daytime, service_id);	
			} else {

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
			var el = jQuery("#addAvailibilityModal #availibilityTableDiv");
			el.html(data);
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}