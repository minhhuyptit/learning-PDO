<?php
class Pagination{
	
	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 2;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 3;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại
	
	public function __construct($totalItems, $pagination){
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
		
		if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;
		
		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
	}
	
	public function getTotalPage(){
		return $this->totalPage;
	}
	
	public function showPagination($link = null){
		// Pagination
		$paginationHTML = '';
		if($this->totalPage > 1){
			$start 	= '<li class="disabled"><a href="#">«</a></li>';
			$prev 	= '<li class="disabled"><a href="#">‹</a></li>';
			if($this->currentPage > 1){
				$page = $this->currentPage-1;
				$start 	= '<li><a href="#"  onclick="javascript:changePage(1)">«</a></li>';
				$prev 	= '<li><a href="#"  onclick="javascript:changePage('.$page.')">‹</a></li>';
			}
		
			$next 	= '<li class="disabled"><a href="#">›</a></li>';
			$end 	= '<li class="disabled"><a href="#">»</a></li>';
			if($this->currentPage < $this->totalPage){
				$page = $this->currentPage+1;
				$next 	= '<li><a href="#"  onclick="javascript:changePage('.$page.')">›</a></li>';
				$end 	= '<li><a href="#"  onclick="javascript:changePage('.$this->totalPage.')">»</a></li>';
			}
		
			if($this->pageRange < $this->totalPage){
				if($this->currentPage == 1){
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				}else if($this->currentPage == $this->totalPage){
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				}else{
					$startPage		= $this->currentPage - ($this->pageRange-1)/2;
					$endPage		= $this->currentPage + ($this->pageRange-1)/2;
		
					if($startPage < 1){
						$endPage	= $endPage + 1;
						$startPage = 1;
					}
		
					if($endPage > $this->totalPage){
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			}else{
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for($i = $startPage; $i <= $endPage; $i++){
				if($i == $this->currentPage) {
					$listPages .= '<li class="active"><a href="#">'.$i.'</a></li>';
				}else{
					$listPages .= '<li><a href="#" onclick="javascript:changePage('.$i.')">'.$i.'</a></li>';
				}
			}
			$paginationHTML .= '<ul class="pagination pull-right">' .$start.$prev . $listPages . $next . $end.'</ul>';
		}
		return $paginationHTML;
	}


}