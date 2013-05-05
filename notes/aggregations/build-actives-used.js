use com_d3up;
db.builds.aggregate([
	{
		$match: {
			actives: { $size : 6 }
		}
	},
	{
		$unwind: '$actives'
	},
	{
		$group: {
			_id: {
				class: '$class',
				active: '$actives'
			},
			count: {$sum: 1}
		}
	},
	{
		$sort: {
			count: 1
		}
	}
]);