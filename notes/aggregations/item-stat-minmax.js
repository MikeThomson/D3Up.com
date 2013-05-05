use com_d3up;
db.items.aggregate([
	{
		$limit: 1000000
	},
	{
		$match: {
			quality: {
				$gt: 5
			}
		}
	},
	{
		$group: {
			_id: {
				quality: '$quality',
				name: '$name'
			},
			'attrs_strength_min': {
				$min: '$attrs.strength'
			},
			'attrs_strength_max': {
				$max: '$attrs.strength'
			},
			'attrs_strength_avg': {
				$avg: '$attrs.strength'
			},
			count: { $sum: 1 }, 
		}
	},
	{
		$sort: {
			count: 1
		}
	}
]);