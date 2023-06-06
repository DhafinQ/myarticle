
<?php $__env->startSection('title'); ?>
    <?php echo e('MyArticle | ' . $article->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="pt-3"></div>
    <div class="col-lg-9 pt-5">
        
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card">
                    <img src="<?php echo e($article->getBanner()); ?>" alt="" width="100%" height="200px" style="object-fit:cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title"><?php echo e($article->title); ?></h4>
                            <p><?php echo e($article->getDate()); ?></p>
                        </div>
                        <div class="text-black">
                            <?php echo $article->content; ?>

                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="">
                                <span class="badge p-2 me-2 my-1 bg-secondary"><?php echo e($article->category->name); ?></span>
                            </div>
                            <div class="">
                                <a href="<?php echo e(url('article/edit/'.$article->id)); ?>" class="btn btn-warning btn-sm">Edit Article</a>
                                <button type="button" class="btn btn-sm btn-danger" id="del-btn">
                                    Delete Article
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <h2 class="my-3">
            Recomendation For You
        </h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php $__currentLoopData = $recomendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recomend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <a href="<?php echo e(route('article.show',$recomend->id)); ?>">
                    <div class="card">
                        <img src="<?php echo e($recomend->getBanner()); ?>" alt="" width="100%" height="180px" style="object-fit:cover;">
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title w-75"><?php echo e($recomend->title); ?></h5> <small class="text-muted"><?php echo e($recomend->getDate()); ?></small>
                            </div>
                            <div class="card-text text-black"><?php echo $recomend->firstSentence(); ?></div>
                            <div>
                                <span class="badge p-2 me-2 my-1 bg-secondary"><?php echo e($recomend->category->name); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>


    <div class="col-lg-3">
        <div class="sticky-md-top pt-1">
            <div class="mt-5 ">
                
            </div>

            <div class="card">
                <div class="card-body">
                                    
                    <?php $__currentLoopData = $myArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('article.show',$my->id)); ?>">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info text-white rounded p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ms-2 pt-2">
                                <div class="h6 overflow-hidden"><?php echo e($my->shortTitle()); ?></div>
                                <small class="text-black"><?php echo $my->firstPhrase(); ?></small>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <h5 class="my-3" style="font-style: normal;">All Categories
                    </h5>

                    <div class="d-flex flex-wrap">
                        <form action="<?php echo e(url('/')); ?>" method="get">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="submit" name="category" value="<?php echo e($category->id); ?>" class="btn btn-sm btn-rounded-pill btn-secondary my-1" ><?php echo e($category->name); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                    </div>
                </div>
            </div>
            

            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
                integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
            <script>
            $(document).on('click', '#del-btn', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#28C76F',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        $.ajax({
                            'url': '<?php echo e(url('article/'.$article->id)); ?>',
                            'type': 'POST',
                            'data': {
                                '_method': 'DELETE',
                                '_token': '<?php echo e(csrf_token()); ?>',
                            },
                            success: function (response) {
                                if (response.message) {
                                   window.location.href = "/article";
                                }
                            }
                        });
                    } else {
                        console.log(`dialog was dismissed by ${result.dismiss}`)
                    }
                });
        });
            </script>
            
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/articles/show.blade.php ENDPATH**/ ?>