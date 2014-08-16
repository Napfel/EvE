<?php

class Debug {

	public static function this($var) {

		echo "<div style='background-color:#333;color:#fff;padding:2px;border: 1px solid #fff;overflow:scroll;text-align:left;'><pre>";
		echo self::debug_code($var);
		echo "</pre>";
		foreach (self::stack() as $index => $line) {

			echo str_repeat("&nbsp;",$index*2).$line."<br />"; 
		}
		echo "</div>";
	}

	private static function debug_code($var) {

		$data = "<span style='color:".self::type_color($var)." !important'><i>".  gettype($var)."</i></span> ";

		if(is_array($var)) {

			$data .= "<ul>";

			foreach($var as $key => $sub) {

				$data .= "<li><strong>".  htmlentities($key).":</strong> ".self::debug_code($sub)."</li>";
			}

			$data .= "</ul>";
		}
		else if(is_null($var)) {

			$data .= "<span style='color:#33f !important'>NULL</span>";
		}
		else if(is_numeric($var)) {

			$data .= "<span style='color:#f3f3f3 !important'>".$var."</span>";
		}
		else if(is_bool($var)) {

			if($var) {

				$data .= "<span style='color:#3f3 !important'>true</span>";
			}
			else {

				$data .= "<span style='color:#f33 !important'>false</span>";
			}
		}
		else if(is_string($var)) {

			$data .= htmlentities($var);
		}
		else if(is_object($var)) {

			$data = get_class($var)."{<br /><ul>";
			foreach($var as $key => $value) {

				$data .= "<li><strong>".htmlentities($key)."<strong>: ".self::debug_code($value)."<br /></li>";
			}

			$data .= "</ul>}";
		}

		return $data;
	}

	private static function stack() {

		$data = array();
		$root = dirname(dirname(dirname(__DIR__)));

		foreach (debug_backtrace() as $var) {

			$data[] = substr(str_replace($root,"",$var['file']),1).":".$var['line'];
		}

		$data = array_slice($data, 1, count($data) -1);

		return $data;
	}

	private static function type_color($var) {

		$color = '';

		if(is_array($var)) {

			$color .= '#66d9ef';
		}
		else if(is_null($var)) {

			$color .= '#ae81ff';
		}
		else if(is_numeric($var)) {

			$color .= '#75715e';
		}
		else if(is_bool($var)) {

			$color .= '#f92672';
		}
		else if(is_string($var)) {

			$color .= '#e6db74';
		}
		else if(is_object($var)) {

			$color .= '#66d9ef';
		}

		return $color;
	}
}