package com.dupirefr;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

/**
 * Home controller
 * @author dupirefr
 */
@Controller
public class HomeController {

	/*
	 * Methods
	 */
	@RequestMapping("/")
	@ResponseBody
	public String home() {
		return "Hello World!";
	}

}
