	tinymce.PluginManager.add('placeholder', function(editor) {
		editor.on('init', function() {
			var label = new Label;
			tinymce.DOM.bind(label.el, 'click', onFocus);
			editor.on('focus', onFocus);
			editor.on('blur', onBlur);
			editor.on('change', onChange);
			editor.on('setcontent', onSetContent);
			editor.on('wp-toolbar-toggle', onToolbarToggle);
			function onFocus() {
				if (!editor.settings.readonly === true) {
					label.hide();
				}
				editor.execCommand('mceFocus', false);
			}
			function onBlur() {
				label.check();
			};
			function onChange() {
				label.check();
			};
			function onToolbarToggle() {
				label.setPosition();
			};
			function onSetContent() {
				label.check();
			};
			setTimeout(function() {
				label.check();
			}, 1000);
		});
		var Label = function() {
			this.text = editor.getElement().getAttribute("placeholder");
			this.contentAreaContainer = editor.getContentAreaContainer();
			tinymce.DOM.setStyle(this.contentAreaContainer, 'position', 'relative');
			attrs = {
				style: {
					position: 'absolute',
					top: '67px',
					left: 0,
					color: '#888',
					padding: '1%',
					width: '98%',
					overflow: 'hidden',
					display: 'none',
					'white-space': 'pre-wrap'
				}
			};
			this.el = tinymce.DOM.add(this.contentAreaContainer, "label", attrs, this.text);
		};
		Label.prototype.check = function() {
			if (editor.getContent() == '' && editor.isDirty() == false) {
				this.show();
			} else {
				this.hide();
			};
		};
		Label.prototype.setPosition = function() {
			var padding_top = tinymce.DOM.getStyle(this.contentAreaContainer, 'padding-top');
			if (padding_top) {
				tinymce.DOM.setStyle(this.el, 'top', padding_top);
			}else{
				tinymce.DOM.setStyle(this.contentAreaContainer, 'position', 'relative');
				tinymce.DOM.setStyle(this.el, 'top', 0);
			};
		};
		Label.prototype.hide = function() {
			tinymce.DOM.setStyle(this.el, 'display', 'none');
		};
		Label.prototype.show = function() {
			this.setPosition();
			tinymce.DOM.setStyle(this.el, 'display', '');
		};
	});
