/**
 * @author Ryan Johnson <ryan@livepipe.net>
 * @copyright 2007 LivePipe LLC
 * @package Control.TextArea.ToolBar.BBCode
 * @license MIT
 * @url http://livepipe.net/projects/control_textarea/bbcode
 * @version 1.0.0
 */

Control.TextArea.ToolBar.BBCode = Class.create();
Object.extend(Control.TextArea.ToolBar.BBCode.prototype,{
	textarea: false,
	toolbar: false,
	options: {
		preview: false
	},
	initialize: function(textarea,options){
		this.textarea = new Control.TextArea(textarea);
		this.toolbar = new Control.TextArea.ToolBar(this.textarea);
		if(options)
			for(o in options)
				this.options[o] = options[o];
		
		//buttons
		this.toolbar.addButton('Bold',function(){
			this.wrapSelection('[b]','[/b]');
		},{
			id: 'bbcode_bold_button',
			title: 'Bold'
		});
		
		this.toolbar.addButton('Italics',function(){
			this.wrapSelection('[i]','[/i]');
		},{
			id: 'bbcode_italics_button',
			title: 'Italics'
		});

		this.toolbar.addButton('Underline',function(){
			this.wrapSelection('[u]','[/u]');
		},{
			id: 'bbcode_underline_button',
			title: 'Underline'
		});
		
		this.toolbar.addButton('Strikethrough',function(){
			this.wrapSelection('[s]','[/s]');
		},{
			id: 'bbcode_strikethrough_button',
			title: 'Strikethrough'
		});		

		this.toolbar.addButton('Link',function(){
			selection = this.getSelection();
			response = prompt('Enter Link URL','');
			if(response == null)
				return;
			if (selection == '')
			{
				linkText = prompt('Enter link title', '');
				
				if (linkText == null)
					linkText = 'External Link';
			}
			if (response.match(":") && (response.indexOf(":") < 8))
				this.replaceSelection('[url=' + response + ']' + (selection == '' ? linkText : selection) + '[/url]');
			else
				this.replaceSelection('[url=' + (response == '' ? 'http://link_url/' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'http://') + ']' + (selection == '' ? linkText : selection) + '[/url]');
		},{
			id: 'bbcode_link_button',
			title: 'Link'
		});	
		
		this.toolbar.addButton('Image',function(){
			selection = this.getSelection();
			response = prompt('Enter Image URL','');
			if(response == null)
				return;
			this.replaceSelection('[img]' + (response == '' ? 'http://image_url/' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'http://') + '[/img]');
		},{
			id: 'bbcode_image_button',
			title: 'Image'
		});

		this.toolbar.addButton('Quote',function(){
			this.wrapSelection('[quote]','[/quote]');
		},{
			id: 'bbcode_quote_button',
			title: 'Quote'
		});
		
		this.toolbar.addButton('Left Align',function(){
			this.wrapSelection('[left]','[/left]');
		},{
			id: 'bbcode_left_button',
			title: 'Left Align'
		});	

		this.toolbar.addButton('Center Align',function(){
			this.wrapSelection('[center]','[/center]');
		},{
			id: 'bbcode_center_button',
			title: 'Center Align'
		});	

		this.toolbar.addButton('Right Align',function(){
			this.wrapSelection('[right]','[/right]');
		},{
			id: 'bbcode_right_button',
			title: 'Right Align'
		});	

		this.toolbar.addButton('Bullet List',function(){
			selection = this.getSelection();
			
			done	= false;
			i		= 0;
			items	= new Array();
			
			while (!done)
			{
				response = prompt('Enter List Item ' + (i + 1),'');
				if(response == null)
					done = true;
				else
					items[i] = response;
				++i;
			}
			
			if (items.length < 1)
				return;
			
			this.replaceSelection('[list]\n[*]' + (items.join('\n[*]')).replace(/^(?!(f|ht)tps?:\/\/)/,'') + '\n[/list]');
		},{
			id: 'bbcode_bullets_button',
			title: 'Bullet List'
		});

		this.toolbar.addButton('Ordered List',function(){
			selection = this.getSelection();
			
			done	= false;
			i		= 0;
			items	= new Array();
			
			while (!done)
			{
				response = prompt('Enter List Item ' + (i + 1),'');
				if(response == null)
					done = true;
				else
					items[i] = response;
				++i;
			}
			
			if (items.length < 1)
				return;
			
			this.replaceSelection('[order]\n[*]' + (items.join('\n[*]')).replace(/^(?!(f|ht)tps?:\/\/)/,'') + '\n[/order]');
		},{
			id: 'bbcode_list_button',
			title: 'Ordered List'
		});	

		this.toolbar.addButton('Color',function(){
			selection = this.getSelection();
			response = prompt('Enter Text Color','');
			if(response == null)
				return;
			this.replaceSelection('[color=' + (response == '' ? 'black' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'') + ']' + (selection == '' ? '' : selection) + '[/color]');
		},{
			id: 'bbcode_color_button',
			title: 'Text Color'
		});

		this.toolbar.addButton('Size',function(){
			selection = this.getSelection();
			response = prompt('Enter Text Size (numeric)','');
			if(response == null)
				return;
			this.replaceSelection('[size=' + (response == '' ? '12' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'') + ']' + (selection == '' ? '' : selection) + '[/size]');
		},{
			id: 'bbcode_size_button',
			title: 'Text Size'
		});			
		
		this.toolbar.addButton('Youtube',function(){
			selection = this.getSelection();
			response = prompt('Enter Youtube Video ID','');
			if(response == null)
				return;
			this.replaceSelection('[youtube]' + (response == '' ? 'youtube_id' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'') + '[/youtube]');
		},{
			id: 'bbcode_youtube_button',
			title: 'Youtube'
		});	

		this.toolbar.addButton('Hide',function(){
			this.wrapSelection('[hide]','[/hide]');
		},{
			id: 'bbcode_hide_button',
			title: 'Hide Post Content'
		});
		
		this.toolbar.addButton('Spoiler',function(){
			this.wrapSelection('[spoiler]','[/spoiler]');
		},{
			id: 'bbcode_spoiler_button',
			title: 'Spoiler Tag'
		});

		this.toolbar.addButton('Anchor',function(){
			selection = this.getSelection();
			response = prompt('Enter Anchor Name','');
			if(response == null)
				return;
			this.replaceSelection('[anchor=' + (response == '' ? 'my_anchor' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'') + ']');
		},{
			id: 'bbcode_anchor_button',
			title: 'Post Anchor'
		});	

		this.toolbar.addButton('Jump',function(){
			selection = this.getSelection();
			response = prompt('Enter Anchor Name to Jump To','');
			if(response == null)
				return;
			this.replaceSelection('[jump=' + (response == '' ? 'my_anchor' : response).replace(/^(?!(f|ht)tps?:\/\/)/,'') + ']' + (selection == '' ? 'Anchor Jump Text' : selection) + '[/jump]');
		},{
			id: 'bbcode_jump_button',
			title: 'Post Anchor Jump'
		});	
		
		this.toolbar.addButton('Raw Code',function(){
			this.wrapSelection('[code]','[/code]');
		},{
			id: 'bbcode_code_button',
			title: 'Raw Code'
		});
		
		this.toolbar.addButton('PHP Code',function(){
			this.wrapSelection('[php]<?php\n','\n?>[/php]');
		},{
			id: 'bbcode_php_button',
			title: 'PHP Code'
		});
		


	}
});