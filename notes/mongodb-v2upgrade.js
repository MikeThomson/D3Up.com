// Inverse how builds are hidden, so we can use a sparse index.
db.builds.update({private: false}, {$set: {public: true}}, {multi: true});
db.builds.update({private: true}, {$set: {public: false}, $unset: {private: 1}}, {multi: true});