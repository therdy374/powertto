<?php
$page_title = "Winning Details";

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


    @media screen and (max-width:768px) {
        .container .header h2 {
        font-size: 25px;
        margin-top: 50px;
    }
}

</style>

<section class="container">
    <?php alertMessage(); ?>
    <!-- <h1 class="content-tit visual04"><span>로또안내</span></h1> -->
    <div class="header">
        <h2>당첨내역</h2>
        <div class="btn-w">
            <a href="lotto_pb.php">파워또 구매하기</a>
        </div>
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>로또안내</span>
            <span>당첨내역</span>
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="purchase_details.php">당첨내역</a></li>
        </ul>
        
        <div class="inner-contents">
            <div class="img-prize mt30 img-prize-logo"><img src="./asset/images/newPtto.jpg" alt="파월볼"></div>
            <?php
            error_reporting(E_ALL);  // Enable error reporting
            ini_set('display_errors', 1);


            include "includes/connect.php";

            $user_id = $_SESSION['loggedInUser']['user_id'];
            $results_per_page = 20;

            // Get total row count
            $sql2 = "SELECT COUNT(*) AS row_count FROM user_purchases WHERE user_id= '$user_id' AND to_received != 0";
            $query_run2 = mysqli_query($conn, $sql2);

            if ($query_run2) {
                $row = $query_run2->fetch_assoc();
                $rowCount = $row['row_count'];
                $totalPages = ceil($rowCount / $results_per_page);

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting index for the results on the current page
                $start_index = ($currentPage - 1) * $results_per_page;

                // Fetch user purchases with pagination
                $sql = "SELECT * FROM user_purchases WHERE user_id = '$user_id' AND to_received != 0 ORDER by `date_purchase` DESC LIMIT $start_index, $results_per_page ";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
            ?>
                        <h3 class="tit-h3 mt50">총 당첨내역: <strong><span class="t-red"><?php echo $rowCount; ?></span></strong></h3>
                        
                        <div class="m-overflow mt10">
                            <table class="table-comm w100p" cellpadding="0" cellspacing="0">
                                <colgroup>
                                    <col style="width:20%">
                                    <col style="width:20%">
                                    <col style="width:20%">
                                    <col style="width:20%">
                                    <col style="width:20%">
                                    <col style="width:20%">
                                    <col style="width:20%">
                                <thead>
                                    <tr>
                                        <th>사용자 ID</th>
                                        <th>구매번호</th>
                                        <th>승리 매치 번호</th>
                                        <th>파워볼 매치 번호</th>
                                        <th>지급상</th>
                                        <th>구매 모드</th>
                                        <th>구매일자</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    while ($row = mysqli_fetch_assoc($result)) {

                                        // Explode, sort, and implode the selected_numbers
                                        $selectedNumbers = explode(',', $row["selected_numbers"]);
                                        sort($selectedNumbers);
                                        $sortedNumbers = implode(', ', $selectedNumbers);

                                        // Explode, sort, and implode the match_numbers
                                        $matchNumbers = explode(',', $row["winning_match_numbers"]);
                                        sort($matchNumbers);
                                        $sortedMatch = implode(', ', $matchNumbers);

                                        echo "<tr data-id='" . $row['id'] . "'>";
                                        echo '
                                            <td>' . $row["username"] . '</td>
                                            <td class="t-c">
                                                ' . $sortedNumbers . ', <span class="t-red"> ' . $row["powerballs"] . '</span>
                                            </td>
                                            <td class="t-c">
                                            ' . $sortedMatch . '
                                            </td>
                                            <td class="t-c">
                                            ' . $row["powerball_match"] . '
                                            </td>
                                            
                                            <td class="t-c">' . number_format($row["to_received"]) . ' ₩</td>
                                            <td class="t-c">
                                            ' . $row["modes"] . '
                                            </td>
                                            <td class="t-c">' . date('Y.m.d h:i(A)', strtotime($row['date_purchase'])) . '</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Pagination controls centered -->
                            <div class="pagination-container">
                                <div class="pagination">
                                    <?php
                                    // Define a function to generate pagination links
                                    function generatePagination($totalPages, $currentPage)
                                    {
                                        $pagination = '<div class="pagination">';

                                        // Previous button
                                        if ($currentPage > 1) {
                                            $pagination .= '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                                        }

                                        // First page
                                        if ($currentPage > 2) {
                                            $pagination .= '<a href="?page=1">1</a>';
                                        }

                                        // Ellipsis after the first page
                                        if ($currentPage > 3) {
                                            $pagination .= '<span>...</span>';
                                        }

                                        // Pages before the current page
                                        for ($i = max(1, $currentPage - 1); $i < $currentPage; $i++) {
                                            $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
                                        }

                                        // Current page
                                        $pagination .= '<span class="active">' . $currentPage . '</span>';

                                        // Pages after the current page
                                        for ($i = $currentPage + 1; $i <= min($totalPages, $currentPage + 1); $i++) {
                                            $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
                                        }

                                        // Ellipsis before the last page
                                        if ($currentPage < $totalPages - 2) {
                                            $pagination .= '<span>...</span>';
                                        }

                                        // Last page
                                        if ($currentPage < $totalPages - 1) {
                                            $pagination .= '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
                                        }

                                        // Next button
                                        if ($currentPage < $totalPages) {
                                            $pagination .= '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                                        }

                                        $pagination .= '</div>';

                                        return $pagination;
                                    }

                                    // Generate pagination links
                                    echo generatePagination($totalPages, $currentPage);
                                    ?>

                                </div>
                            </div>
                        </div>
            <?php
                    } else {
                        echo "No Winning Record Found";
                    }
                } else {
                    echo "Error in SQL query: " . mysqli_error($conn);
                }
            } else {
                echo "Error in fetching row count: " . mysqli_error($conn);
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