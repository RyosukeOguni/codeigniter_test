<?php
class News extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('news_model');
    $this->load->helper('url_helper');
  }

  // Newsの一覧を表示
  public function index()
  {
    $data['news'] = $this->news_model->get_news();
    $data['title'] = 'News archive';
    $this->load->view('templates/header', $data);
    $this->load->view('news/index', $data);
    $this->load->view('templates/footer');
  }

  //Newsの詳細を表示
  public function view($slug = NULL)
  {
    $data['news_item'] = $this->news_model->get_news($slug);
    if (empty($data['news_item'])) {
      ehow_404();
    }
    $data['title'] = $data['news_item']['title'];
    $this->load->view('templates/header', $data);
    $this->load->view('news/view', $data);
    $this->load->view('templates/footer');
  }
}
