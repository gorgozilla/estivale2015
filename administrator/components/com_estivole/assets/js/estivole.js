function addDayTimeModal(daytime_id, start_hour, end_hour)
{
	jQuery("#addDayTimeModal").modal('show');

	if(daytime_id==''){
		jQuery("#addDayTimeModal #daytime_id").val('');	
		jQuery("#addDayTimeModal #quota").val('');	
	}else{
		jQuery("#addDayTimeModal #daytime_id").val(daytime_id);
	}
	jQuery("#addDayTimeModal #jformdaytime_hour_end").attr('value', end_hour);
	jQuery("#addDayTimeModal #jformdaytime_hour_end").trigger("liszt:updated");
	jQuery("#addDayTimeModal #jformdaytime_hour_start").attr('value', start_hour);
	jQuery("#addDayTimeModal #jformdaytime_hour_start").trigger("liszt:updated");
}

function addAvailibilityModal(member_id)
{
	jQuery("#addAvailibilityModal").modal('show');
	jQuery("#addAvailibilityModal #member_id").val(member_id);
	var calendar_id = jQuery("#calendar_selector").val();
	getCalendarDates(calendar_id);
	jQuery("#jformdaytime").chosen().change( function(){
		var daytime = jQuery(this).val();
		getCalendarDaytimes(calendar_id, daytime);
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
				
				var daytime = jQuery("#jformdaytime").val();
				getCalendarDaytimes(calendar_id, daytime);	
			} else {

			}
		},
       error : function(resultat, statut, erreur){
			alert(erreur);
       }
	});
}

function getCalendarDaytimes(calendar_id, daytime)
{
	jQuery.ajax({
		url:'index.php?option=com_estivole&controller=member&view=member&layout=_availibilitytable&format=raw&tmpl=component',
		type:'POST',
		data: 'calendar_id='+calendar_id+'&daytime='+daytime,
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

function returnBookModal(book_id)
{
	jQuery("#returnBookModal").modal('show');
	jQuery("#book_id").val(book_id);
}

function returnBook()
{
	var postInfo = {};
	jQuery("#returnForm :input").each(function(idx,ele){
		postInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
	});

	jQuery.ajax({
		url:'index.php?option=com_lendr&controller=lend&format=raw&tmpl=component',
		type:'POST',
		data: postInfo,
		dataType: 'JSON',
		success:function(data)
		{
			if(data.success)
			{
				jQuery("#returnBookModal").modal('hide');
			} else {

			}
		}
	});
}

function cancelRequest(waitlist_id) 
{
	jQuery.ajax({
		url:'index.php?option=com_lendr&controller=delete&format=raw&tmpl=component',
		type:'POST',
		data: 'waitlist_id='+waitlist_id,
		dataType: 'JSON',
		success:function(data)
		{
			alert(data.msg);
		}
	});
}

function deleteBook(book_id,type) 
{
	jQuery.ajax({
		url:'index.php?option=com_lendr&controller=delete&format=raw&tmpl=component',
		type:'POST',
		data: 'book_id='+book_id+'&type='+type,
		dataType: 'JSON',
		success:function(data)
		{
			alert(data.msg);
			if(data.success)
			{
				jQuery("tr#bookRow"+book_id).hide();
			}
		}
	});
}