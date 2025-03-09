<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Audit Logs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-container {
            display: flex;
            height: calc(100vh - 3rem);
            overflow: hidden;
        }

        .left-section,
        .right-section {
            overflow-y: auto;
            padding: 1rem;
        }

        .left-section {
            flex: 2;
        }

        .right-section {
            background-color: #f9fafb;
            border-left: 1px solid #e5e7eb;
            width: 350px;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="main-container">

        <div class="left-section py-6 mx-3 ">
            <div class="bg-white overflow-y-auto shadow-2xl rounded-lg h-[800px] ">
                <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6 sticky top-0 z-10">
                    <h4 class="text-3xl text-center uppercase text-white ">Admin Audit Logs</h4>
                </div>

                <div class="p-6 flex flex-wrap  ">
                    <!-- Log entries -->
                    <?php if (empty($logs)): ?>
                        <div class="col-span-full text-center py-4 text-gray-500">
                            No Audit Logs Yet
                        </div>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                            <div class="flex-1 m-2 log-entry  sm:flex-nowrap md:flex-nowrap  items-center justify-between bg-white shadow-lg rounded-lg p-6 
    transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl ">
                                <div class="flex items-center space-x-4 sm:space-x-6 md:space-x- w-full sm:w-auto md:w-auto">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 
            flex items-center justify-center text-white text-lg sm:text-2xl font-semibold">
                                        <?= strtoupper(substr(htmlspecialchars($log['username']), 0, 1)) ?>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-lg sm:text-xl font-semibold text-gray-800">
                                            <?= htmlspecialchars($log['username']) ?>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <?= htmlspecialchars($log['action']) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex-1 w-full sm:w-auto text-right sm:text-left mt-2 sm:mt-0">
                                    <p class="text-xs sm:text-sm text-gray-500">
                                        <?= date('F j, Y, g:i a', strtotime($log['timestamp'])) ?>
                                    </p>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="right-section bg-white hidden 2xl:block">

        </div>
    </div>

</body>

</html>