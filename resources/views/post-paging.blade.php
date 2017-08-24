<div class="post-paging">
  @if ($page > 1)
    <a href="/?page={{ $page - 1 }}">Previous</a>
  @endif

  @for ($p = 1; $p <= $pages; $p++)
    <a href="/?page={{ $p }}" class="number @if ($p == $page) active @endif">{{ $p }}</a>
  @endfor

  @if ($page < $pages)
    <a href="/?page={{ $page + 1 }}">Next</a>
  @endif
</div>