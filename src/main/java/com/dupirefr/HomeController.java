package com.dupirefr;

import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
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
	public String indexAction() {
		return "home";
	}

}
