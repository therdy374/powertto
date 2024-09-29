<?php
$page_title = "Customer Details";

require "./includes/menubar.php";

?>

<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination a {
        padding: 8px 12px;
        margin: 0 4px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
        border-radius: 4px;
    }

    .pagination a.active {
        background-color: #3b5ccb;
        color: white;
        border: 1px solid #3b5ccb;
    }

    .highlight {
        background-color: lightblue;
    }

    .depth2-menu .item.select2 a,
    .depth2-menu .item a:hover {
        background: #03363d;
        color: #FFF;
    }
</style>


<section class="container">
    <?php alertMessage(); ?>

    <div class="header">
        <h2>1:1 문의 하기</h2>

        <!-- <div class="navi">
            <button type="text" name="dep_req" class="btn-comm btn-gr w2p max-w-2"><a href="customer_service.php">1:1 문의 하기</a></button>
        </div> -->
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <!-- <li class="item select"><a href="customer_service.php">고객 요청</a></li> -->
        </ul>

        <div class="inner-contents">

            <div class="table-head">
                <div class="search-w">
                    <a href="customer_service.php" class="btn-comm btn-dpk">1:1 문의 하기</a>
                </div>
            </div>

            <?php

            $user_id = $_SESSION['loggedInUser']['user_id'];

            $results_per_page = 10;

            // Get total row count
            $sql2 = "SELECT COUNT(*) AS row_count FROM customer_service WHERE user_id= '$user_id' ";
            $query_run2 = mysqli_query($conn, $sql2);

            if ($query_run2->num_rows > 0) {
                $row = $query_run2->fetch_assoc();
                $rowCount = $row['row_count'];
                $totalPages = ceil($rowCount / $results_per_page);

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting index for the results on the current page
                $start_index = ($currentPage - 1) * $results_per_page;

                // Fetch user purchases with pagination
                $sql = "SELECT * FROM customer_service WHERE user_id = $user_id ORDER BY `date_message` DESC LIMIT $start_index, $results_per_page";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
            ?>
                    <h3 class="tit-h3 mt50">고객 서비스</h3>
                    <strong><span class="t-red">전체 <?php echo $rowCount; ?> 건이 검색되었습니다.</span></strong>
                    <div class="m-overflow mt10">
                        <table class="table-comm w100p" cellpadding="0" cellspacing="0">
                            <colgroup>

                                <col style="width:20%">
                                <col style="width:20%">
                                <col style="width:20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>제목</th>
                                    <th>문의일시</th>
                                    <th>문의상태</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $num = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id']; // Assuming $id is fetched from $row
                                    echo '
                                    <tr data-id="' . $id . '">
                                        <td class="t-c">
                                            <span class="t-red"><a href="cust_inquiry.php?id=' . $id . '">' . $row["title"] . '</a></span>
                                        </td>
                                        <td class="t-c">' . date('Y.m.d(D) h:i:s(A)', strtotime($row['date_message'])) . '</td>
                                        <td class="t-c">' . $row["status"] . '</td>
                                    </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                        <!-- Pagination controls centered -->
                        <div class="pagination-container">
                            <div class="pagination">
                                <?php
                                if ($currentPage > 1) {
                                    echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                                }

                                for ($page = 1; $page <= $totalPages; $page++) {
                                    echo '<a ' . ($page == $currentPage ? 'class="active"' : '') . ' href="?page=' . $page . '">' . $page . '</a>';
                                }

                                if ($currentPage < $totalPages) {
                                    echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
                    echo "문의하신 내역이 없습니다.";
                }
            }
            ?>

        </div>

    </div>
</section>

<script>
    function markRow(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var row = document.querySelector("tr[data-id='" + id + "']");
                    row.classList.toggle('highlight');
                } else {
                    console.error("Error updating record");
                }
            }
        };
        xhr.open("GET", "update_marked.php?id=" + id, true);
        xhr.send();
    }
</script>

<?php include "./includes/footer.php"; ?>