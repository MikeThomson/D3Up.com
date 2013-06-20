<?php
class Scripts_Task {
	
	protected $_node = '/usr/local/bin/node';
	protected $_uglify = '/usr/local/bin/uglifyjs';
	protected $_options = '-m';
	
	public $scriptPath = 'js/';
	
	public function run($args) {
		// Start up the S3 Bundle
		Bundle::start('s3');
		// Get the Scripts from our scripts.php config file
		$scripts = Config::get('scripts.files');
		// Build the Uglify Command to Compress the JS/CSS
		$command = $this->_node ." ". $this->_uglify." ";
		foreach($scripts as $script) {
			$command .= path('public').$this->scriptPath.$script." ";
		}
		$command .= $this->_options;		
		// Run the Uglify Command and store the Output as $compressed
		$compressed = shell_exec($command);
		// Upload script to S3 (http://cdn.d3up.com)
		S3::put_object($compressed, 'cdn.d3up.com', 'main.js', S3::ACL_PUBLIC_READ);		
	}
	
}
