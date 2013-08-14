	
    /*****************************************************************/
    /*****************************************************************/
	
	function submitVotingForm()
	{
		blockForm('voting-form','block');
		$.post('plugin/voting-form/voting-form.php',$('#voting-form').serialize(),submitVotingFormResponse,'json');
	}
	
	/*****************************************************************/
	
	function submitVotingFormResponse(response)
	{
        blockForm('voting-form','unblock');
        $('#voting-form-email,#voting-form-send').qtip('destroy');

        var tPosition=
        {
            'voting-form-send'		: {'my':'left bottom','at':'left top'},
            'voting-form-email'		: {'my':'bottom center','at':'top center'}
        };

        if(typeof(response.info)!='undefined')
        {
            if(response.info.length)
            {
                for(var key in response.info)
                {
                    var id=response.info[key].fieldId;
                    $('#'+response.info[key].fieldId).qtip(
                    {
                            style:      { classes:(response.error==1 ? 'ui-tooltip-error' : 'ui-tooltip-success')},
                            content: 	{ text:response.info[key].message },
                            position: 	{ my:tPosition[id]['my'],at:tPosition[id]['at'] }
                    }).qtip('show');
                }
            }
        }
	}

	/*****************************************************************/
	/*****************************************************************/	