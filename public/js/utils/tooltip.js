function buildTooltip(elem) {
	// Parse the Items JSON
	var item = $.parseJSON(elem.attr('data-json')),
			builder = new d3up.ItemBuilder;
	// Build all the HTML parts
	var container = $("<div class='d3-tooltip'/>"),
			header = $("<div class='top'/>"),
			content = $("<div class='item'/>"),
			footer = $("<div class='bottom'/>"),
			itemIcon = $("<div class='item-icon'/>"),
			itemName = $("<p/>"),
			itemLabel = $("<p class='item-type'/>"),
			itemQuality = $("<span class='quality'/>"),
			itemType = $("<span class='type'/>"),
			itemPrimary = $("<p class='stats stats-primary'/>"),
			itemPrimaryBigStat = $("<span class='big-stat'/>"),
			itemPrimaryHelper = $("<span class='stat-helper'/>"),
			itemExtraPercent = $("<p class='stats stats-extra-percent'/>"),
			itemExtraRange = $("<p class='stats stats-extra-range'/>"),
			itemAttrs = $("<ul class='attrs'/>"),
			itemSockets = $("<ul class='sockets'/>"),
			itemSetBonus = $("<div class='setBonus quality-7'/>");
	// Set the Name of the Item
	itemName.html(item.name);
	// Set the Quality of the Item
	itemType.html(item.type.charAt(0).toUpperCase() + item.type.slice(1));
	// Fix up the Tooltip Icon
	itemQuality.html(builder.qualityMap[item.quality])
	if(item && item.icon && item.quality) {
		itemIcon.addClass("item-quality-" + item.quality);
		itemIcon.html("<img src='http://media.blizzard.com/d3/icons/items/large/" + item.icon + ".png'>");
		content.append(itemIcon);		
	}
	// Add the Header to the Tooltip
	container.append(header.append(itemName.addClass("quality-" + item.quality)).addClass("quality-" + item.quality));
	container.append(content);
	container.append(footer);
	// Add the Item Type, Item Quality and class for quality to the content
	content.append(itemLabel.addClass("quality-" + item.quality).append(itemQuality, ' ', itemType));
	if(item.stats) {
		// Is this armor?
		if(item.stats.armor > 0) {
			// Add the Armor Value
			itemPrimaryBigStat.html(item.stats.armor);
			itemPrimaryHelper.html("Armor");
			// Is this a shield?
			if(item.stats['block-chance'] > 0 && item.type == 'shield') {
				// Add the Block Values
				itemExtraPercent.html(item.stats['block-chance'] + " <span class='stat-helper'>Chance to Block</span>");
				if(item.stats['block-amount']) {
					itemExtraRange.html(item.stats['block-amount']['min'] + "-" + item.stats['block-amount']['max'] + " <span class='stat-helper'>Block Amount</span>");					
				}
			} 
		}
		// Is this a weapon?
		if(item.stats.dps > 0) {
			// Add the DPS Value, Attack Speed and damage range
			itemPrimaryBigStat.html(Math.round(item.stats.dps * 100) / 100);
			itemPrimaryHelper.html("Damage Per Second");
			itemExtraPercent.html(Math.round(item.stats['speed'] * 100) / 100 + " <span class='stat-helper'>Attacks per Second</span>");
			if(item.stats['damage']) {
				itemExtraRange.html(item.stats['damage']['min'] + "-" + item.stats['damage']['max'] + " <span class='stat-helper'>Damage</span>");				
			}
		}
		// Add the BigStat and Helper to the primary
		itemPrimary.append(itemPrimaryBigStat, itemPrimaryHelper);
		// Append the collected data onto the content
		content.append(itemPrimary, itemExtraPercent, itemExtraRange);			
	}
	if(item.attrs) {
		// Loop through attrs and add
		$.each(item.attrs, function(k, v) {
			if(text = builder.getSkillText(k, v)) {
				itemAttrs.append("<li>" + text + "</li>");
			}
		});
		// Append Attrs to content
		content.append(itemAttrs);			
	}
	// Do we have sockets?
	if(item.sockets) {
		$.each(item.sockets, function(k,v) {
			var itemClass = builder.getItemClass(item.type), 
					text = null;
			if(itemClass == 'weapon') {
				// Weapon Effects
				var effect = builder.gemEffect[v][2][0],
						value = builder.gemEffect[v][2][1];
			} else if(_.indexOf(["spirit-stone","voodoo-mask","wizard-hat","helm"], item.type) >= 0) {
				// Helm Effects
				var effect = builder.gemEffect[v][1][0],
						value = builder.gemEffect[v][1][1];
			} else {
				// Other Effects
				var effect = builder.gemEffect[v][3][0],
						value = builder.gemEffect[v][3][1];
			}
			text = builder.getSkillText(effect, value);
			itemSockets.append("<li class='gem_" + item.sockets[k] + "'>" + text + "</li>");
		});
		content.append(itemSockets);
	}
	
	if(item.set) {
		var data = builder.getBonusHtml(item.set);
		itemSetBonus.empty().append(data.name, data.list);
		// console.log(elem.attr("data-set-count"));
		if(elem.attr("data-set-count")) {
			var count = elem.data("set-count");
			if(data.list) {
				data.list.find("div.data-count").each(function() {
					if(elem.data("count") <= count) {
						elem.addClass("quality-7");					
					}
				});				
			}
		}			
		content.append(itemSetBonus);
	}
	
	return container;
}

$.fn.tooltipCompare = function() {
	// Define the Tooltip Div
	var tooltip = $("#d3up-tooltip-compare");
	// If we have no JSON, return false immediately
	if(!$(this).attr('data-json') || !$(this).attr('data-compare')) {
		return false;
	}

	
	// Bind the mouse
	$(this).mouseover(function() {
		var $this = $(this);
		var elements = $("a[data-compare=" + $(this).attr('data-compare') + "]"),
				container = $("<div>"),
				diff = $("<div>").css({backgroundColor: '#000', textAlign: 'center', fontSize: '2em'}).html("VERSUSSSSS!");
		container.append(diff);
		$.each(elements, function() {
			container.append(buildTooltip($(this)));
		});
		tooltip.css({
				position: 'absolute'
		});
		tooltip.empty().append(container);
		var position = {
			of: $this,
			at: "right middle",
			my: "left middle",
			offset: "20 10",
			collision: "flip"
		};
		tooltip.appendTo("body").position(position);
	}).mouseout(function() {
		tooltip.empty();
	});
}

$.fn.tooltip = function() {
	// Define the Tooltip Div
	var tooltip = $("#d3up-tooltip");
	// If we have no JSON, return false immediately
	if(!$(this).attr('data-json')) {
		return false;
	}
	
	var tip = buildTooltip($(this));

	// Bind the mouse
	$(this).mouseover(function() {
		var $this = $(this);
		tooltip.css({
				position: 'absolute'
		});
		tooltip.empty().append(tip);
		var position = {
			of: $this,
			at: "right middle",
			my: "left middle",
			offset: "20 10",
			collision: "flip"
		};
		tooltip.appendTo("body").position(position);
	}).mouseout(function() {
		tooltip.empty();
	});
	
}
function checkTooltip() {
	if($(this).attr('data-json')) {
		if($(this).attr('data-compare')) {
			$(this).tooltipCompare();			
		} else {
			$(this).tooltip();			
		}
	}
}
$(function() {
	$("a").each(checkTooltip);	
});
