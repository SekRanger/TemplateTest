<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Home extends Controller
{
  private function assocId($decodedData)
  {
    foreach ($decodedData as $value) {
      $decoratedData[$value['id']] = $value;
    }

    return $decoratedData;
  }

  private function getJsonData($url)
  {
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($handle);
    curl_close($handle);

    return $this->assocId(json_decode($content, true));
  }

  private function getRoughInterval($interval) {
    $codes = [
      'y' => 'year',
      'm' => 'month'
    ];
    $displayInterval = '';
    foreach ($codes as $code => $v) {
      //echo '<div>' . $interval->$code . '</div>';
      if ($interval->$code) {
        $displayInterval = number_format($interval->$code) . ' ' . $v . ($interval->$code > 1 ? 's' : '');
        break;
      }
    }

    if (!$displayInterval) {
      if ($interval->days > 6 && $interval->h < 30) {
        $weeks = floor($interval->days / 7);
        $displayInterval = number_format($weeks) + ' week' . ($weeks > 1 ? 's' : '');
      } elseif ($interval->days) {
        $days = $interval->days;
        $displayInterval = number_format($days) + ' day' . ($days > 1 ? 's' : '');
      } elseif (($interval->h + $interval->i + $interval->s) > 0) {
        $displayInterval = 'today';
      }
    }

    return $displayInterval;
  }

  private function mapPost(&$item, $key, $args)
  {
    $authors = $args['authors'];
    $now = $args['now'];
    $item['author'] = $authors[$item['author_id']];
    $created = new \DateTime($item['created_at']);
    $item['interval'] = $this->getRoughInterval($now->diff($created));

    return $item;
  }

  private function sortPost($postA, $postB)
  {
    if ($postA['createdTimestamp'] == $postB['createdTimestamp']) {
      return 0;
    }

    return ($postA['createdTimestamp'] < $postB['createdTimestamp']) ? -1 : 1;
  }

  public function index(Request $request)
  {
    $authors = $this->getJsonData('http://maqe.github.io/json/authors.json');
    $posts = $this->getJsonData('http://maqe.github.io/json/posts.json');
    $countPages = (int) ceil(count($posts) / 8);

    if (!($page = ($request->input('page') / 1))) {
      $page = 1;
    }

    if ($page > $countPages) {
      $page = $countPages;
    }

    $walkArgs = [
      'now' => new \DateTime('now'),
      'authors' => $authors
    ];

    array_walk($posts, array($this, 'mapPost'), $walkArgs);
    $posts = array_splice($posts, ($page - 1) * 8, 8);

    $viewArgs = [
      'title' => 'MAQE Forums',
      'subtitle' => 'Subtitle',
      'posts' => $posts,
      'page' => $page,
      'pages' => $countPages
    ];

    return view('posts', $viewArgs);
  }
}
