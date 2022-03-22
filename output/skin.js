// Garden Gnome Software - Skin
// Pano2VR 6.1.6/17950
// Filename: anuncio360.ggsk
// Generated 2022-01-14T12:30:21

function pano2vrSkin(player,base) {
	player.addVariable('ht_ani', 2, false);
	var me=this;
	var skin=this;
	var flag=false;
	var hotspotTemplates={};
	var skinKeyPressed = 0;
	this.player=player;
	this.player.skinObj=this;
	this.divSkin=player.divSkin;
	this.ggUserdata=player.userdata;
	this.lastSize={ w: -1,h: -1 };
	var basePath="";
	// auto detect base path
	if (base=='?') {
		var scripts = document.getElementsByTagName('script');
		for(var i=0;i<scripts.length;i++) {
			var src=scripts[i].src;
			if (src.indexOf('skin.js')>=0) {
				var p=src.lastIndexOf('/');
				if (p>=0) {
					basePath=src.substr(0,p+1);
				}
			}
		}
	} else
	if (base) {
		basePath=base;
	}
	this.elementMouseDown=[];
	this.elementMouseOver=[];
	var cssPrefix='';
	var domTransition='transition';
	var domTransform='transform';
	var prefixes='Webkit,Moz,O,ms,Ms'.split(',');
	var i;
	var hs,el,els,elo,ela,elHorScrollFg,elHorScrollBg,elVertScrollFg,elVertScrollBg,elCornerBg;
	if (typeof document.body.style['transform'] == 'undefined') {
		for(var i=0;i<prefixes.length;i++) {
			if (typeof document.body.style[prefixes[i] + 'Transform'] !== 'undefined') {
				cssPrefix='-' + prefixes[i].toLowerCase() + '-';
				domTransition=prefixes[i] + 'Transition';
				domTransform=prefixes[i] + 'Transform';
			}
		}
	}
	
	player.setMargins(0,0,0,0);
	
	this.updateSize=function(startElement) {
		var stack=[];
		stack.push(startElement);
		while(stack.length>0) {
			var e=stack.pop();
			if (e.ggUpdatePosition) {
				e.ggUpdatePosition();
			}
			if (e.hasChildNodes()) {
				for(var i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
	}
	
	this.callNodeChange=function(startElement) {
		var stack=[];
		stack.push(startElement);
		while(stack.length>0) {
			var e=stack.pop();
			if (e.ggNodeChange) {
				e.ggNodeChange();
			}
			if (e.hasChildNodes()) {
				for(var i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
	}
	player.addListener('changenode', function() { me.ggUserdata=player.userdata; me.callNodeChange(me.divSkin); });
	
	var parameterToTransform=function(p) {
		var hs='translate(' + p.rx + 'px,' + p.ry + 'px) rotate(' + p.a + 'deg) scale(' + p.sx + ',' + p.sy + ')';
		return hs;
	}
	
	this.findElements=function(id,regex) {
		var r=[];
		var stack=[];
		var pat=new RegExp(id,'');
		stack.push(me.divSkin);
		while(stack.length>0) {
			var e=stack.pop();
			if (regex) {
				if (pat.test(e.ggId)) r.push(e);
			} else {
				if (e.ggId==id) r.push(e);
			}
			if (e.hasChildNodes()) {
				for(var i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
		return r;
	}
	
	this.addSkin=function() {
		var hs='';
		this.ggCurrentTime=new Date().getTime();
		el=me._crosshair=document.createElement('div');
		els=me._crosshair__img=document.createElement('img');
		els.className='ggskin ggskin_crosshair';
		hs='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAKklEQVQImWP4//8/w////xkYGBgaYGwmBiyAkYGBoQHKbkBiwwFcAKt2AP1CDnqHspqBAAAAAElFTkSuQmCC';
		els.setAttribute('src',hs);
		els.ggNormalSrc=hs;
		els.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;-webkit-user-drag:none;pointer-events:none;;');
		els.className='ggskin ggskin_image';
		els['ondragstart']=function() { return false; };
		player.checkLoaded.push(els);
		el.appendChild(els);
		el.ggSubElement = els;
		el.ggId="crosshair";
		el.ggDx=0.5;
		el.ggDy=0.5;
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=true;
		el.className="ggskin ggskin_image ";
		el.ggType='image';
		hs ='';
		hs+='height : 5px;';
		hs+='left : -10000px;';
		hs+='position : absolute;';
		hs+='top : -10000px;';
		hs+='visibility : inherit;';
		hs+='width : 5px;';
		hs+='pointer-events:auto;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		me._crosshair.ggIsActive=function() {
			return false;
		}
		el.ggElementNodeId=function() {
			return player.getCurrentNode();
		}
		me._crosshair.ggUpdatePosition=function (useTransition) {
			if (useTransition==='undefined') {
				useTransition = false;
			}
			if (!useTransition) {
				this.style[domTransition]='none';
			}
			if (this.parentNode) {
				var pw=this.parentNode.clientWidth;
				var w=this.offsetWidth;
					this.style.left=(this.ggDx + pw/2 - w/2) + 'px';
				var ph=this.parentNode.clientHeight;
				var h=this.offsetHeight;
					this.style.top=(this.ggDy + ph/2 - h/2) + 'px';
			}
		}
		me.divSkin.appendChild(me._crosshair);
		el=me._ht_node_timer=document.createElement('div');
		el.ggTimestamp=this.ggCurrentTime;
		el.ggLastIsActive=true;
		el.ggTimeout=500;
		el.ggId="ht_node_timer";
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=true;
		el.className="ggskin ggskin_timer ";
		el.ggType='timer';
		hs ='';
		hs+='height : 32px;';
		hs+='left : 62px;';
		hs+='position : absolute;';
		hs+='top : 23px;';
		hs+='visibility : inherit;';
		hs+='width : 32px;';
		hs+='pointer-events:none;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		me._ht_node_timer.ggIsActive=function() {
			return (me._ht_node_timer.ggTimestamp==0 ? false : (Math.floor((me.ggCurrentTime - me._ht_node_timer.ggTimestamp) / me._ht_node_timer.ggTimeout) % 2 == 0));
		}
		el.ggElementNodeId=function() {
			return player.getCurrentNode();
		}
		me._ht_node_timer.ggActivate=function () {
			player.setVariableValue('ht_ani', true);
		}
		me._ht_node_timer.ggDeactivate=function () {
			player.setVariableValue('ht_ani', false);
		}
		me._ht_node_timer.ggUpdatePosition=function (useTransition) {
		}
		me.divSkin.appendChild(me._ht_node_timer);
		player.addListener('sizechanged', function() {
			me.updateSize(me.divSkin);
		});
	};
	this.hotspotProxyClick=function(id, url) {
	}
	this.hotspotProxyDoubleClick=function(id, url) {
	}
	me.hotspotProxyOver=function(id, url) {
	}
	me.hotspotProxyOut=function(id, url) {
	}
	me.callChildLogicBlocksHotspot_ht_node_changenode = function(){
		if(hotspotTemplates['ht_node']) {
			var i;
			for(i = 0; i < hotspotTemplates['ht_node'].length; i++) {
				if (hotspotTemplates['ht_node'][i]._ht_node_image && hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_scaling) {
					hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_scaling();
				}
				if (hotspotTemplates['ht_node'][i]._ht_node_image_visited && hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_scaling) {
					hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_scaling();
				}
			}
		}
	}
	me.callChildLogicBlocksHotspot_ht_node_mouseover = function(){
		if(hotspotTemplates['ht_node']) {
			var i;
			for(i = 0; i < hotspotTemplates['ht_node'].length; i++) {
				if (hotspotTemplates['ht_node'][i]._tt_ht_node && hotspotTemplates['ht_node'][i]._tt_ht_node.logicBlock_visible) {
					hotspotTemplates['ht_node'][i]._tt_ht_node.logicBlock_visible();
				}
			}
		}
	}
	me.callChildLogicBlocksHotspot_ht_node_changevisitednodes = function(){
		if(hotspotTemplates['ht_node']) {
			var i;
			for(i = 0; i < hotspotTemplates['ht_node'].length; i++) {
				if (hotspotTemplates['ht_node'][i]._ht_node_image && hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_visible) {
					hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_visible();
				}
				if (hotspotTemplates['ht_node'][i]._ht_node_image_visited && hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_visible) {
					hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_visible();
				}
			}
		}
	}
	me.callChildLogicBlocksHotspot_ht_node_varchanged_ht_ani = function(){
		if(hotspotTemplates['ht_node']) {
			var i;
			for(i = 0; i < hotspotTemplates['ht_node'].length; i++) {
				if (hotspotTemplates['ht_node'][i]._ht_node_image && hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_scaling) {
					hotspotTemplates['ht_node'][i]._ht_node_image.logicBlock_scaling();
				}
				if (hotspotTemplates['ht_node'][i]._ht_node_image_visited && hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_scaling) {
					hotspotTemplates['ht_node'][i]._ht_node_image_visited.logicBlock_scaling();
				}
			}
		}
	}
	player.addListener('changenode', function() {
		me.ggUserdata=player.userdata;
	});
	me.skinTimerEvent=function() {
		me.ggCurrentTime=new Date().getTime();
		if (me._ht_node_timer.ggLastIsActive!=me._ht_node_timer.ggIsActive()) {
			me._ht_node_timer.ggLastIsActive=me._ht_node_timer.ggIsActive();
			if (me._ht_node_timer.ggLastIsActive) {
				player.setVariableValue('ht_ani', true);
			} else {
				player.setVariableValue('ht_ani', false);
			}
		}
	};
	player.addListener('timer', me.skinTimerEvent);
	function SkinHotspotClass_ht_node(parentScope,hotspot) {
		var me=this;
		var flag=false;
		var hs='';
		me.parentScope=parentScope;
		me.hotspot=hotspot;
		var nodeId=String(hotspot.url);
		nodeId=(nodeId.charAt(0)=='{')?nodeId.substr(1, nodeId.length - 2):''; // }
		me.ggUserdata=skin.player.getNodeUserdata(nodeId);
		me.elementMouseDown=[];
		me.elementMouseOver=[];
		me.findElements=function(id,regex) {
			return skin.findElements(id,regex);
		}
		el=me._ht_node=document.createElement('div');
		el.ggId="ht_node";
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=true;
		el.className="ggskin ggskin_hotspot ";
		el.ggType='hotspot';
		hs ='';
		hs+='height : 0px;';
		hs+='left : 78px;';
		hs+='position : absolute;';
		hs+='top : 39px;';
		hs+='visibility : inherit;';
		hs+='width : 0px;';
		hs+='pointer-events:auto;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		me._ht_node.ggIsActive=function() {
			return player.getCurrentNode()==this.ggElementNodeId();
		}
		el.ggElementNodeId=function() {
			if (me.hotspot.url!='' && me.hotspot.url.charAt(0)=='{') { // }
				return me.hotspot.url.substr(1, me.hotspot.url.length - 2);
			} else {
				if ((this.parentNode) && (this.parentNode.ggElementNodeId)) {
					return this.parentNode.ggElementNodeId();
				} else {
					return player.getCurrentNode();
				}
			}
		}
		me._ht_node.onclick=function (e) {
			player.openUrl(me.hotspot.url,me.hotspot.target);
			skin.hotspotProxyClick(me.hotspot.id, me.hotspot.url);
		}
		me._ht_node.ondblclick=function (e) {
			skin.hotspotProxyDoubleClick(me.hotspot.id, me.hotspot.url);
		}
		me._ht_node.onmouseover=function (e) {
			player.setActiveHotspot(me.hotspot);
			me._tt_ht_node.style[domTransition]='none';
			me._tt_ht_node.style.visibility=(Number(me._tt_ht_node.style.opacity)>0||!me._tt_ht_node.style.opacity)?'inherit':'hidden';
			me._tt_ht_node.ggVisible=true;
			me.elementMouseOver['ht_node']=true;
			me._tt_ht_node.logicBlock_visible();
			skin.hotspotProxyOver(me.hotspot.id, me.hotspot.url);
		}
		me._ht_node.onmouseout=function (e) {
			player.setActiveHotspot(null);
			me._tt_ht_node.style[domTransition]='none';
			me._tt_ht_node.style.visibility='hidden';
			me._tt_ht_node.ggVisible=false;
			me.elementMouseOver['ht_node']=false;
			me._tt_ht_node.logicBlock_visible();
			skin.hotspotProxyOut(me.hotspot.id, me.hotspot.url);
		}
		me._ht_node.ontouchend=function (e) {
			me.elementMouseOver['ht_node']=false;
			me._tt_ht_node.logicBlock_visible();
		}
		me._ht_node.ggUpdatePosition=function (useTransition) {
		}
		el=me._tt_ht_node=document.createElement('div');
		els=me._tt_ht_node__text=document.createElement('div');
		el.className='ggskin ggskin_textdiv';
		el.ggTextDiv=els;
		el.ggId="tt_ht_node";
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=false;
		el.className="ggskin ggskin_text ";
		el.ggType='text';
		hs ='';
		hs+='z-index: 100;';
		hs+='height : 20px;';
		hs+='left : -50px;';
		hs+='position : absolute;';
		hs+='top : 21px;';
		hs+='visibility : hidden;';
		hs+='width : 100px;';
		hs+='pointer-events:auto;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		hs ='position:absolute;';
		hs += 'box-sizing: border-box;';
		hs+='cursor: default;';
		hs+='left: 0px;';
		hs+='top:  0px;';
		hs+='width: auto;';
		hs+='height: auto;';
		hs+='background: #000000;';
		hs+='background: rgba(0,0,0,0.666667);';
		hs+='border: 0px solid #000000;';
		hs+='color: rgba(255,255,255,1);';
		hs+='text-align: center;';
		hs+='white-space: nowrap;';
		hs+='padding: 2px 5px 2px 5px;';
		hs+='overflow: hidden;';
		els.setAttribute('style',hs);
		els.innerHTML=me.hotspot.title;
		el.appendChild(els);
		me._tt_ht_node.ggIsActive=function() {
			if ((this.parentNode) && (this.parentNode.ggIsActive)) {
				return this.parentNode.ggIsActive();
			}
			return false;
		}
		el.ggElementNodeId=function() {
			if ((this.parentNode) && (this.parentNode.ggElementNodeId)) {
				return this.parentNode.ggElementNodeId();
			}
			return me.ggNodeId;
		}
		me._tt_ht_node.logicBlock_visible = function() {
			var newLogicStateVisible;
			if (
				((me.elementMouseOver['ht_node'] == true))
			)
			{
				newLogicStateVisible = 0;
			}
			else {
				newLogicStateVisible = -1;
			}
			if (me._tt_ht_node.ggCurrentLogicStateVisible != newLogicStateVisible) {
				me._tt_ht_node.ggCurrentLogicStateVisible = newLogicStateVisible;
				me._tt_ht_node.style[domTransition]='';
				if (me._tt_ht_node.ggCurrentLogicStateVisible == 0) {
					me._tt_ht_node.style.visibility=(Number(me._tt_ht_node.style.opacity)>0||!me._tt_ht_node.style.opacity)?'inherit':'hidden';
					me._tt_ht_node.ggVisible=true;
				}
				else {
					me._tt_ht_node.style.visibility="hidden";
					me._tt_ht_node.ggVisible=false;
				}
			}
		}
		me._tt_ht_node.ggUpdatePosition=function (useTransition) {
			this.style[domTransition]='left 0';
			this.ggTextDiv.style.left=((98-this.ggTextDiv.offsetWidth)/2) + 'px';
		}
		me._ht_node.appendChild(me._tt_ht_node);
		el=me._ht_node_image=document.createElement('div');
		els=me._ht_node_image__img=document.createElement('img');
		els.className='ggskin ggskin_ht_node_image';
		hs='data:image/png;base64,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';
		els.setAttribute('src',hs);
		els.ggNormalSrc=hs;
		els.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;-webkit-user-drag:none;pointer-events:none;;');
		els.className='ggskin ggskin_button';
		els['ondragstart']=function() { return false; };
		player.checkLoaded.push(els);
		el.appendChild(els);
		el.ggSubElement = els;
		hs='data:image/png;base64,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';
		me._ht_node_image__img.ggOverSrc=hs;
		hs='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUcAAAFTCAYAAACqDs7mAAAZMklEQVR4nO3dPWxbR7rG8YeL28m93Ev1tQF269T21la5gN0tAbnz4mq7XGy2ul7EnQ0wnV1sJ9cr11E6AtbWVE/1dM1bzEuHUY4+yDNzZt6Z/w8w5MSJPIDOPHzn84xWq5UAAL/1h9wNAIASEY4A0IFwBIAOhCMAdCAcAaAD4QgAHQhHAOhAOAJAB8IRADoQjgDQgXAEgA6EIwB0IBwBoAPhCAAdCEcA6EA4AkAHwhEAOhCOANCBcASADoQjAHQgHAGgw3/lbgDqMprMHkrat398vPFHj679p3uSDrf41nNJX6/9u4uN33+xr1er6XixxfcFOo14NSu2NZrMHkl6aL8OJD3Y+FqKpaTLja8LSYvVdHxx6/8FGMIRNxpNZocKVeChQuW3rxCI3i0kXS'+
			'lUnnOFanOet0koDeEISdJoMnugEIDrILw+DG7BhX4NzIvVdLzM3B5kRDg2ysLwiUIY/re2m/9rxVzSf+zrOWHZFsKxITZX+J0Iw12tw/Jn5i7rRzhWbKM6fCzpjyprwcS7paRfFFbJqSorRDhWZiMQ178wjPP1L4KyDoRjBQjE4hCUFSAcHbM5xD+JIXOp1kPvfzNH6Q/h6IxVic8kPVcdew5bsZD0SdIZ1aQPhKMTG1Xi09xtQW+fRTVZPMKxcKPJbF0lsvWmPnNJn1bT8VnuhuD3CMcC2dD5SKFKZOhcv4VCNXnKkLschGNBNkLxuVhgadFSYV6SkCwA4VgAQhHXEJIFIBwzIhRxB0IyI8IxA0IRWyIkMyAcB2arzy/EQgu2t5D0kdXtYRCOA7F9isdiSw76m0t6zz7JtAjHxOydKsfizDPiO1cISd6ZkwDhmNBo'+
			'Mnsp5hWR1lJhI/mH3A2pDeGYAENoZMBQOzLCMSJbhV5Xi0AOnyR9YFW7P8IxEqsWT8QqNPJbSHpDFdkP4diTVYvHCteIASU5UxhqU0XugHDsgWoRDlBF7ohw3NFoMnsl5hbhx6fVdPwudyM8IRy3ZPsW/y5WouHPXNL/si/yfgjHLdjRv2OxbxF+LRXmITmCeAfC8Z5Gk9mJWHRBPc5W0/Gb3I0oGeF4B4bRqBjD7Fv8IXcDSmar0VMRjKjToaSpPee4hsrxBqPJ7EhhfhFowfvVdHyauxElIRw7ML+IRjEPuYFw3GCnXX6QxDADrbqQ9D2naphz/MYWXn4UwYi2PZL0o/WHplE5ShpNZocKwcj+RSBYSvrrajqe525ILs1XjrZSRzACv/VAoYJsdiTVdOVoJ15OcrcDKNybFk/UNBuOBOMglpIu7fdfNv79pf3ZdV'+
			'er6Xhh8137HX/+QNLBxj8/tq8HovJPrbmAbDIcCcboLhSuxporBN/XHHNVNne8pxCWhwpXyTU7LEygqYBsLhwJxt7mCmF4oVDpFT9hb6G5rxCUj8SJpz6aCcimwpFg3Mlc4RWgFzVdmGoLDY8UXplLWG6niYBsJhwJxntbKoThF0m/tLAZ2Db//1FhDvOJmL+8j+oDsolwJBjvtFAIxM8ehsmp2TD8qUJQNr8Z+hZVB2T14Ugw3mhdIZ6vpuPz3I0p1Wgye6IQklSU3aoNyKrDkWDsdCHp36vp+HPuhngzmsyeSvqTWAG/rsqArDYcbcL9be52FGKp8JrOT1xs2p/tw3yucHMT1WTwuqYFO6nScOSs9DcLSacKc4nVL6wMzRZynko6EnOT1Z3Fri4c7VN9qraDcS7plKHzcGzIfaS2twUtJU1qGZ1UFY72Sf6j2n1A'+
			'Fwo3OrPAkokt4Byr3UpyrlBBuh+p1BaOb9XmZPlC0gcqxXJYJflSbYbkxWo6fp27EX1VE46NvtpgKekdoVguC8lXam+ax/0rF6oIx9Fk9lzhAWzJB4XVZ/fDl9rZdM9zhUqyJe9W0/Gn3I3YlftwbHDLzrnCvGIVk94tscXCY4UN5a1wu8XHdTg2tjK9VNhsy2KLc7Zoc6J2nluXK9jeX5Pwd7XxgJ1K+jPBWAf7Of5Z4edauwcK/dQdt5VjIwswC4Vq0eWwBHezaaET1b+q7W6BxmXlaGemaw/GM4XhCMFYMfv5ThR+3jV7Zv3WDXeVYwPzjMwtNqqBuUhX848eK8ea5xkvFB4egrFB9nOfKDwHNXI1/+iqchxNZscK51drdLqajt/nbgTKwLOen5twrHg/41Jh32Ltc07Yks3RHavOkVLx+x9dhKOdMJiqvhW9ua'+
			'R/1nTNE+Ky6/f+R/VdprJQmEIq9oSXlznHGm85Wd9eQjDiRvZ8/FXheanJ+rRQsYqvHCsdTrvb84X8Kt3bW+zwuuhwrHQ4/WE1HX/M3Qj4NJrMXqiuCyyKHV6XPqx+obqC8Q3BiD7s+alp1PFQoZ8Xp9hwtOF0TVsZqnxDG4Znz1FNAXlk/b0oxYajCp+s3RLBiKgqDMji+nuR4WjzKjVsXVgqTDgTjIjOnqvXCs+Zd4fW74tRXDja2elahtPfl7oShzrY8/V97nZEcmT9vwjFhaPqORHAVWMYhD1nNQyxH6ig4XVR4WiTsjVcIc8cIwZV0Rzkk1IWZ4oKRxX0qdEDwYgsKgrIInKgmHC0V1h6X4T5SDAiJ3v+vO+lPbQ8yKqIcLSTMN53/Z+tpuMPuRsB2HPo/UP6peVCNkWEo8I7fYtZpdrBnLPSKIk9j54vq3io'+
			'kAvZZA9H+3TwvHVnfWsKUBrvt/kc5awes4ejwqeD1607S4X7GGvYhIvK2HP5T/ndJP5AGavHrOFYQdX4nvsYUTJ7Pot/JcEtslWPuStHz1XjJ1am4YE9p59yt2NH2arHbOHovGq8WE3H73I3Argve169ntjKUj3mrBy9Vo1L1bHRFu15I5/zj1mqxyzh6LxqfOPlpeTAJntuvX6wD1495qocvVaNZ/bidcAle349zpUPXj3mCkePLwlayPeqH7D2XuF59mbQ3Bg8HO3MpMfTMG/Yz4ga2HPscXj9cMgz1zkqR49zjZ+4mxE1sefZ4/aewfJj0HC0e9q83byzlMSFEqjRB/lbvT4c6r7HoStHj3ONDKdRJcfD60FyZLBwtGV4b+F4zuo0ambPt7dn/NkQ23qGrByzX165A1an0QKPz3nyPBkyHL0txHxkszdaYM+5t9'+
			'vDk+fJIOFoE6ietu8sJZ3mbgQwoFP5Wpx5mHphZqjK0dtc43sWYdASe969Da+T5krycLSJU0+vW11wFRlaZM+9p6mkJykXZoaoHP8oX+eovc29ADF5ev4fKORLEkOE43cD/B2xUDWiaQ6rx2T5kjQcHQ6pvc25ACl46gfJhtapK8dkJW8CczZ8A982hnt6N1KSnEkdjp6G1B4P4QOpeOoPSXImWTg6G1Iz1whscDb3mGRonbJy9DSk9vQpCQzFU7+Injcpw/Fxwu8d01I+r40HUjuTn1Mz0fMmZTh6GVJ/5jQM8HvWLz7nbsc9Rc+bJOFoZx69bPzmDDVwMy/940Hss9apKkcvVeMFN+8AN7P+4eUVIVFzJ1U4DnKNeQTMNQJ389JPyq4cbUndw3tilmzfAe5m/cTDvPxhzC09KSpHL1t4fsndAMARL/0lWv6kCEcP'+
			'VaMk/Zy7AYAjXvpLtPxJEY4e5hsXnKMG7s/6i4fFy2j5EzUcHc03ehkiACXx0G+izTvGrhw9VI2Sn9U3oCRe+k2UHIodjgeRv18Ky9V07Ok6JqAI1m88rFpHyaHY4ejhPLWHoQFQKg/9J0oOtTis/pK7AYBjHvpPWcPq0WTmYSFGklilBnbnov/EyKOYleN+xO+VypwbeIDdWf/xMGffO49ihqOHxRgP8yVA6Tz0o955FDMcPSzGeJgvAUrnoR/1zqOmhtWr6djL1UtAsZz0o6KG1Q8jfq8UPMyTAF6U3p9651GUcIx9A28i/8ndAKAixfenvrkUq3IsfkgtH/MkgBce+lOvXIoVjqUPqSXpKncDgIp46E+9cilWOBa/AZzz1EA8TvpTr1yKFY6lv2nQw+oa4E3p/apXLsUKx9I3gHsYAgDelN6veuVSK5WjhyEA4E'+
			'3p/Spv5TiazDwsxpT+QwQ8Kr5f9cmnGJWjh208X3M3AKiQh361cz6leMFWcZysrAGu1N6vYoRj6adjuKIMSKf0/rVzPrVQOV7mbgBQsWr7VwvhCABbixGOpd/jWPpGVcCz0vvXzvlE5QgAHQhHAOjQQjhWvd0AyKza/hUjHPcifI+USt9qAHhWev/aOZ9ihGPx15UBaNbO+dTCsBoAtkY4AkAHwhEAOrQQjqVfyAl4Vm3/qj4cV9PxIncbgFrV3L+qD0cnl/ECLtXcv6oPR/m4jBfwqtr+1UI4AsDWCEcA6EA4AkCHGOFY7cFzAO7tnE8xwrH0N5CV/k5twLPS+9fO+dTCsJqLMYB0qu1fLYQjAGyNcASADjHC8UuE75FS6e/VBjwrvX/tnE9UjgDQoYVwrHbCGChAtf0rRjiW/t7a0t9xA3hWev/aOZ9aqBw1msyq'+
			'/XQDcqm9X8UIRw/3uZX+6QZ45KFf7ZxPvcNxNR17uAm46k84IJPi+1WffIo1rC793bXF/xABh0rvV71yKVY4Xkb6PqlUeyEnkFHp/apXLrVSOZa+URXwqPR+VUTlWPy1ZbWvrAFDctKfeuVSrHD0sGJd+hAA8MRDf+qVS7HC0cOK9ePcDQAq4qE/9cqlKOG4mo5LPyUjlT8/AnhSfH/qm0sxT8iUPrQ+yN0AoCKl96feeRQzHIsfWo8ms+I/7YDSOelHvfMoZjiWfq+j5GOeBCidh37UO49ihmPpG8El6UnuBgAV8NCPeudRS3OOknQwmsxKf1saUCzrP6XPN0olzTmupmMPlaPk41MPKJWL/hMjj2Lf5+hhS4+H+RKgVB76T5Qcih2OHhZlXHzyAYXy0H+i5FDscPQwtN5zci4UKIr1Gw8X3EbJoRYrR0l6lrsBgE'+
			'Ne+k15leNqOv4qBzf0yMfQACiNh34ztxzqLcULtjwsyuyPJjMPP2igCNZfPNzEEy1/UoSjh8pRkr7L3QDAES/9JVr+pAjH8wTfMwUqR+D+vPSXaPkTPRwdzTvujSYzLxPMQDbWTzysUkebb5TSVI6Sj3lHyc/qG5CTl34SNXdShaOXofWj0WT2MHcjgFJZ//BwRZkUOXeShKPdwFv6GwnXjnI3ACiYl/6xjP1GglSVo+SnenzGTT3A71m/8DKkjp43KcPRy2mZPfl5AIAheVmIkRLkDZVj4GXoAAzJU7/wUznakrqXgNxnWw/wK+sPHk7ESNJ5zC08aykrR0n6OfH3j8nTpySQmqf+kCRnUoejl8pRCq9Q8HIKAEjG+oGHVyGsJcmZpOHobGgtSa9yNwAogKd+kGRILaWvHCVfQ2vmHtE0Z3ONUsJ8GSIcz+VnQ7gk'+
			'vczdACAjT8//UglHpsnD0eHQmuoRTXJYNSYbUkvDVI6SdDbQ3xPLK07NoCX2vHuaa5QS58og4WhnHnu/ZHtAe/K1lQHo60h+TsNI0iL2WerrhqocJel0wL8rhhfc2IMW2HP+Inc7tpQ8T4YMR29Da0k6zt0AYAAen/PkeTJYONrEqbeAfMLGcNTMnm9vz/hZyoWYtSErR8lfOErS31icQY3suf5b7nbsYJAcGTQcbQLVw/tlNu3J194v4L5eytcijBTeEzPIa1iGrhwlfwszkvR8NJl5uSoeuJM9z89zt2MHg+XH4OG4mo4/y9e2njWG16iC4+H0wvJjEDkqR8nn3OO+/G2SBbq8kq+TMGuD5kaucDyVr/PWa09ZvYZn9vw+zd2OHSw18JRclnC0ZXiPc49SGF6zORzu2HPrcTgtSadDbN/ZlKtylPxWj3uSTnI3At'+
			'jBifytTksZqkYpYzg6rx4fjSYz5h/hhj2vXndcDF41SnkrR8lv9SiF7T1cbYbi2XPqcduOlKlqlDKHo/PqUQpXmx3mbgRwE3s+PY9yslSNUv7KUfJdPe5JOmH/I0pkz6XXeUYpY9UoFRCOFVSPB5Le5m4E0OGtfL1F8LpsVaNUQDiaU/k8NbN2MJrMvG6RQIXsefQcjAtlLpqKCEf7dPiQux09PR1NZlxQgezsOfS40XvTh5xVo1RIOErfzlx7u7HnuhesYCMne/683ep93XzIM9Q3KSYczfvcDYjghIBEDvbc1XBAoYgcKCoc7Z42T69xvQkBiUFVFIznQ93XeJeiwtG8k9+tPZtOuAMSQ7DnrIZgXCr0/yIUF46r6fhKvrf2bPoHAYmU7Pn6R+52RHJq/b8IxYWjJK2m44/yvzgjhc23bxliIwV7rt7K7ybvTXPr'+
			'98UoMhxNEZOykTAHiagqmmNcK66/FxuONilby/BaIiARSYXBeFrKIsymYsPRfJDvkzPXnbBRHH3Y81NTMC5U6AGQosPRdsi/yd2OyF5w1BC7sOfG+wbv697kPglzk9FqtcrdhjuNJrMTSbUNSS8lvV5NxzVsW0JCdruO90skupytpuNii5+iK8cN71TX8Fqy23y4DxK3seejxmBcqKA9jV1chGOlw2vp14CsrSpGBBtbdWoLRqng4fSai3CUqly9XltfmOv5tmZEZs+D54tqb1Pk6vR1LuYcN40ms6mkWoeiFwqfqLVNIeCe7PWpJ/L7Mqy7zFfT8SR3I+7DTeW44XvVcfa6yyNJP9mL19EY+7n/pHqDcanQf11wVzlK0mgyeyq/Lye/r8+S3rGaXT9bjX4l/xfU3uX/Srin8b48Vo7ri3HPcrcjsacKVWStVQT07e'+
			'KIn1R/MJ55CkbJaeW4Vvn846ZPCtfGU0VWwqrFl/L7PultuJln3OSyctxQ8/zjpueS/sVcZB3s5/gvtRGMruYZN7muHKVvw5KWXo16Luk9K9r+2Er0saSWPuRee9i208V9OErSaDJ7rjCh3ZKPCvvFWqicXbMh9JHqOxd9l3er6fhT7kbsqopwlKo9f32XrwoPYO2LU27ZKZdXqnMz922KPjd9H9WEoySNJrO3qneP2G2uFBZsCMlCWCi+lLSfuy0ZXKym49e5G9FXbeG4pzD/2MIKdpcrhUqyhjc4umSLLa/UZihK4fUmr0s/N30fVYWjJI0ms32FfWMPcrclo0uF+UgqyYFYpXikOi+JuK+lpL+U9JKsPqoLR0kaTWYHChVkywEphUryVGH+h4WbyGyhZR2KrVaKa0uFivEyd0NiqTIcpSa3+Nzmq8KJolO2APVn'+
			'W3KOFIKxtYWWm7jdsnOTasNRauYM9rYuFCpJhtxbsqHzM7W56HcbV2em76vqcJQIyFt8VdhQ/jMLODezBZbvFDZuUyX+XpXBKDUQjhIBeQ9XCkF5tpqO57kbk5u9muCZQiC2Ppd4m2qDUWokHCUCcgvrivKLpPMWFnJsYeWJpMeiQryvqoNRaigcJQJyR5eysKxpwt0W7NZh2PL2m11UH4xSY+EoEZARXCos6nyRdOVhGG7D5H2FMHwkwrCPJoJRajAcJQIygQuFecu5/fqaIzQtBPcUTkitA5GV5XiaCUap0XCUCMiBfFUISykE6Npc3fdwXq2m44XtI+xaCHmg3x4NXQffOhSRTlPBKDUcjhIBCdxTc8EoNR6O0reJ+R/EUUPguqWk72taiNtG8+EocRYb6FDdWelteX+HTBT2APxFv86PAS2bK9yu02wwSoTjN3'+
			'bN0mv9duEAaM2FQsVYxbVjfTCs7tDoKxcA9682iIlwvEGjL+1Cu1y/DCsFwvEWrGSjAU2vSN+GOcdb2APDQg1qtV54IRg7UDneE/OQqAzzi3cgHLdgJ2peiWE2/FoqzC82d+JlW4Tjluzthj+o3de/wq+5wvxi89t07oNw3NFoMjtWeMkS4MHpajp+n7sRnhCOPdhq9omkh7nbAtxgIekNiy7bIxx7Gk1mewrzkCzWoDRnCvOLX3M3xCPCMRKqSBSEajECwjEiqyJfirlI5HMq6QPVYn+EYwJWRR6LFW0MZy7pPdViPIRjQqPJ7IVCFcm+SKSyVFiJ/pi7IbUhHBOzfZGvFF4BCsR0rrDgwr7FBAjHgTDURkQMoQdAOA7MjiC+FKva2N5CYbGFo38DIBwzsFXtIzEfiftZKqxCn7IKPRzCMSNCEncgFDMiHAtASOIa'+
			'QrEAhGNBCMnmEYoFIRwLtBGSz8TCTQsWCuegCcWCEI6Fs9XtI7EFqEZzhUBk9blAhKMTtk/ymbj9pwZnCq8pYJ9iwQhHZ2zI/UyhmmTI7cdCYT7xjKGzD4SjYxvV5BOxgFOipcIRP6pEhwjHClg1+UTSd+IMdwnOJf0s6Zwq0S/CsTIEZTYEYmUIx4ptBOVjMfSObT1k/iICsUqEY0NsjvKJpEdia9Au5pIuFMKQOcTKEY6N2qgqD0VY3mQdhnNRHTaHcISkb2H5WNKBfX2Ut0VZXCgMky8lfSEM20Y44kajyexAYS/lOjD3VcfeyoWkK/0ahIvVdHyZt0koDeGIrdnc5TooDxUWeg5U1oLPUiH4lgrD4oWkK+YKcV+EI6Kyd+asq8vNofnja//pnrab55xLuj7M/bLx+3XoLXinCmIgHAGgwx9yNwAASkQ4AkAHwh'+
			'EAOhCOANCBcASADoQjAHQgHAGgA+EIAB0IRwDoQDgCQAfCEQA6EI4A0IFwBIAOhCMAdCAcAaAD4QgAHQhHAOhAOAJAB8IRADr8P+DY83mt46ekAAAAAElFTkSuQmCC';
		me._ht_node_image__img.ggDownSrc=hs;
		el.ggId="ht_node_image";
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=true;
		el.className="ggskin ggskin_button ";
		el.ggType='button';
		hs ='';
		hs+='cursor : pointer;';
		hs+='height : 32px;';
		hs+='left : -16px;';
		hs+='position : absolute;';
		hs+='top : -16px;';
		hs+='visibility : inherit;';
		hs+='width : 32px;';
		hs+='pointer-events:auto;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		me._ht_node_image.ggIsActive=function() {
			if ((this.parentNode) && (this.parentNode.ggIsActive)) {
				return this.parentNode.ggIsActive();
			}
			return false;
		}
		el.ggElementNodeId=function() {
			if ((this.parentNode) && (this.parentNode.ggElementNodeId)) {
				return this.parentNode.ggElementNodeId();
			}
			return me.ggNodeId;
		}
		me._ht_node_image.logicBlock_scaling = function() {
			var newLogicStateScaling;
			if (
				((player.getVariableValue('ht_ani') == true))
			)
			{
				newLogicStateScaling = 0;
			}
			else {
				newLogicStateScaling = -1;
			}
			if (me._ht_node_image.ggCurrentLogicStateScaling != newLogicStateScaling) {
				me._ht_node_image.ggCurrentLogicStateScaling = newLogicStateScaling;
				me._ht_node_image.style[domTransition]='' + cssPrefix + 'transform 500ms ease 0ms';
				if (me._ht_node_image.ggCurrentLogicStateScaling == 0) {
					me._ht_node_image.ggParameter.sx = 1.1;
					me._ht_node_image.ggParameter.sy = 1.1;
					me._ht_node_image.style[domTransform]=parameterToTransform(me._ht_node_image.ggParameter);
				}
				else {
					me._ht_node_image.ggParameter.sx = 1;
					me._ht_node_image.ggParameter.sy = 1;
					me._ht_node_image.style[domTransform]=parameterToTransform(me._ht_node_image.ggParameter);
				}
			}
		}
		me._ht_node_image.logicBlock_visible = function() {
			var newLogicStateVisible;
			if (
				((player.nodeVisited(me._ht_node_image.ggElementNodeId()) == true))
			)
			{
				newLogicStateVisible = 0;
			}
			else {
				newLogicStateVisible = -1;
			}
			if (me._ht_node_image.ggCurrentLogicStateVisible != newLogicStateVisible) {
				me._ht_node_image.ggCurrentLogicStateVisible = newLogicStateVisible;
				me._ht_node_image.style[domTransition]='' + cssPrefix + 'transform 500ms ease 0ms';
				if (me._ht_node_image.ggCurrentLogicStateVisible == 0) {
					me._ht_node_image.style.visibility="hidden";
					me._ht_node_image.ggVisible=false;
				}
				else {
					me._ht_node_image.style.visibility=(Number(me._ht_node_image.style.opacity)>0||!me._ht_node_image.style.opacity)?'inherit':'hidden';
					me._ht_node_image.ggVisible=true;
				}
			}
		}
		me._ht_node_image.onmouseover=function (e) {
			me._ht_node_image__img.src=me._ht_node_image__img.ggOverSrc;
		}
		me._ht_node_image.onmouseout=function (e) {
			me._ht_node_image__img.src=me._ht_node_image__img.ggNormalSrc;
		}
		me._ht_node_image.onmousedown=function (e) {
			me._ht_node_image__img.src=me._ht_node_image__img.ggDownSrc;
		}
		me._ht_node_image.onmouseup=function (e) {
			if (skin.player.getIsMobile()) {
				me._ht_node_image__img.src = me._ht_node_image__img.ggNormalSrc;
			} else {
				me._ht_node_image__img.src = me._ht_node_image__img.ggOverSrc;
			}
		}
		me._ht_node_image.ggUpdatePosition=function (useTransition) {
		}
		me._ht_node.appendChild(me._ht_node_image);
		el=me._ht_node_image_visited=document.createElement('div');
		els=me._ht_node_image_visited__img=document.createElement('img');
		els.className='ggskin ggskin_ht_node_image_visited';
		hs=basePath + 'images/ht_node_image_visited.png';
		els.setAttribute('src',hs);
		els.ggNormalSrc=hs;
		els.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;-webkit-user-drag:none;pointer-events:none;;');
		els.className='ggskin ggskin_button';
		els['ondragstart']=function() { return false; };
		player.checkLoaded.push(els);
		el.appendChild(els);
		el.ggSubElement = els;
		hs='data:image/png;base64,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';
		me._ht_node_image_visited__img.ggOverSrc=hs;
		hs='data:image/png;base64,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';
		me._ht_node_image_visited__img.ggDownSrc=hs;
		el.ggId="ht_node_image_visited";
		el.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		el.ggVisible=false;
		el.className="ggskin ggskin_button ";
		el.ggType='button';
		hs ='';
		hs+='height : 32px;';
		hs+='left : -16px;';
		hs+='position : absolute;';
		hs+='top : -16px;';
		hs+='visibility : hidden;';
		hs+='width : 32px;';
		hs+='pointer-events:auto;';
		el.setAttribute('style',hs);
		el.style[domTransform + 'Origin']='50% 50%';
		me._ht_node_image_visited.ggIsActive=function() {
			if ((this.parentNode) && (this.parentNode.ggIsActive)) {
				return this.parentNode.ggIsActive();
			}
			return false;
		}
		el.ggElementNodeId=function() {
			if ((this.parentNode) && (this.parentNode.ggElementNodeId)) {
				return this.parentNode.ggElementNodeId();
			}
			return me.ggNodeId;
		}
		me._ht_node_image_visited.logicBlock_scaling = function() {
			var newLogicStateScaling;
			if (
				((player.getVariableValue('ht_ani') == true))
			)
			{
				newLogicStateScaling = 0;
			}
			else {
				newLogicStateScaling = -1;
			}
			if (me._ht_node_image_visited.ggCurrentLogicStateScaling != newLogicStateScaling) {
				me._ht_node_image_visited.ggCurrentLogicStateScaling = newLogicStateScaling;
				me._ht_node_image_visited.style[domTransition]='' + cssPrefix + 'transform 500ms ease 0ms';
				if (me._ht_node_image_visited.ggCurrentLogicStateScaling == 0) {
					me._ht_node_image_visited.ggParameter.sx = 1.1;
					me._ht_node_image_visited.ggParameter.sy = 1.1;
					me._ht_node_image_visited.style[domTransform]=parameterToTransform(me._ht_node_image_visited.ggParameter);
				}
				else {
					me._ht_node_image_visited.ggParameter.sx = 1;
					me._ht_node_image_visited.ggParameter.sy = 1;
					me._ht_node_image_visited.style[domTransform]=parameterToTransform(me._ht_node_image_visited.ggParameter);
				}
			}
		}
		me._ht_node_image_visited.logicBlock_visible = function() {
			var newLogicStateVisible;
			if (
				((player.nodeVisited(me._ht_node_image_visited.ggElementNodeId()) == true))
			)
			{
				newLogicStateVisible = 0;
			}
			else {
				newLogicStateVisible = -1;
			}
			if (me._ht_node_image_visited.ggCurrentLogicStateVisible != newLogicStateVisible) {
				me._ht_node_image_visited.ggCurrentLogicStateVisible = newLogicStateVisible;
				me._ht_node_image_visited.style[domTransition]='' + cssPrefix + 'transform 500ms ease 0ms';
				if (me._ht_node_image_visited.ggCurrentLogicStateVisible == 0) {
					me._ht_node_image_visited.style.visibility=(Number(me._ht_node_image_visited.style.opacity)>0||!me._ht_node_image_visited.style.opacity)?'inherit':'hidden';
					me._ht_node_image_visited.ggVisible=true;
				}
				else {
					me._ht_node_image_visited.style.visibility="hidden";
					me._ht_node_image_visited.ggVisible=false;
				}
			}
		}
		me._ht_node_image_visited.onmouseover=function (e) {
			me._ht_node_image_visited__img.src=me._ht_node_image_visited__img.ggOverSrc;
		}
		me._ht_node_image_visited.onmouseout=function (e) {
			me._ht_node_image_visited__img.src=me._ht_node_image_visited__img.ggNormalSrc;
		}
		me._ht_node_image_visited.onmousedown=function (e) {
			me._ht_node_image_visited__img.src=me._ht_node_image_visited__img.ggDownSrc;
		}
		me._ht_node_image_visited.onmouseup=function (e) {
			if (skin.player.getIsMobile()) {
				me._ht_node_image_visited__img.src = me._ht_node_image_visited__img.ggNormalSrc;
			} else {
				me._ht_node_image_visited__img.src = me._ht_node_image_visited__img.ggOverSrc;
			}
		}
		me._ht_node_image_visited.ggUpdatePosition=function (useTransition) {
		}
		me._ht_node.appendChild(me._ht_node_image_visited);
		me.__div = me._ht_node;
	};
	me.addSkinHotspot=function(hotspot) {
		var hsinst = null;
		{
			hotspot.skinid = 'ht_node';
			hsinst = new SkinHotspotClass_ht_node(me, hotspot);
			if (!hotspotTemplates.hasOwnProperty(hotspot.skinid)) {
				hotspotTemplates[hotspot.skinid] = [];
			}
			hotspotTemplates[hotspot.skinid].push(hsinst);
			me.callChildLogicBlocksHotspot_ht_node_changenode();;
			me.callChildLogicBlocksHotspot_ht_node_mouseover();;
			me.callChildLogicBlocksHotspot_ht_node_changevisitednodes();;
			me.callChildLogicBlocksHotspot_ht_node_varchanged_ht_ani();;
		}
		return hsinst;
	}
	me.removeSkinHotspots=function() {
		if(hotspotTemplates['ht_node']) {
			var i;
			for(i = 0; i < hotspotTemplates['ht_node'].length; i++) {
				hotspotTemplates['ht_node'][i] = null;
			}
		}
		hotspotTemplates = [];
	}
	me.addSkin();
	var style = document.createElement('style');
	style.type = 'text/css';
	style.appendChild(document.createTextNode('.ggskin { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px;}'));
	document.head.appendChild(style);
	player.addListener('changenode', function(args) { me.callChildLogicBlocksHotspot_ht_node_changenode(); });
	player.addListener('mouseover', function(args) { me.callChildLogicBlocksHotspot_ht_node_mouseover(); });
	player.addListener('changevisitednodes', function(args) { me.callChildLogicBlocksHotspot_ht_node_changevisitednodes(); });
	player.addListener('varchanged_ht_ani', function(args) { me.callChildLogicBlocksHotspot_ht_node_varchanged_ht_ani(); });
	player.addListener('hotspotsremoved', function(args) { me.removeSkinHotspots(); });
	me.skinTimerEvent();
};