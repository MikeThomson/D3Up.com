// Builds
db.builds.ensureIndex({public: 1});
db.builds.ensureIndex({public: 1, 'stats.ehp': -1}, {sparse: true});
db.builds.ensureIndex({public: 1, 'stats.dps': -1}, {sparse: true});
db.builds.ensureIndex({actives: 1, class: 1, public: 1}, {sparse: true});
db.builds.ensureIndex({public: 1, class: 1, 'stats.dps': -1}, {sparse: true});
db.builds.ensureIndex({public: 1, class: 1, 'stats.ehp': -1}, {sparse: true});

// Build Quick Access
//		Used by the User Navbar to load the user's builds
db.builds.ensureIndex({_createdBy: 1, paragon: -1, level: -1});