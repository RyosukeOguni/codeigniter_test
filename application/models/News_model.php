<?php
class News_model extends CI_Model
{
  public function __construct()
  {
    //DBをロードすることにより、このインスタンスで$this->dbが使えるようになる
    $this->load->database();
  }

  public function get_news($slug = FALSE)
  {
    //$slug(ルートパラメーター)がない場合
    if ($slug === FALSE) {
      // newsテーブルの全てを取得
      $query = $this->db->get('news');
      //結果配列としてDB情報をすべて返す
      return $query->result_array();
    }

    //$slug（ルートパラメーター）があった場合、一件を取得
    $slug = urldecode($slug);
    $query = $this->db->get_where('news', array('slug' => $slug));
    return $query->row_array();
  }

  public function set_news()
  {
    $this->load->helper('url');
    $slug = url_title($this->input->post('title'), 'dash', true);
    $data = array(
      'title' => $this->input->post('title'),
      'slug' => $slug,
      'text' => $this->input->post('text'),
    );
    return $this->db->insert('news', $data);
  }
}
