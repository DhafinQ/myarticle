
<?php $__env->startSection('title'); ?>
    MyArticle | Home
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="pt-3"></div>
        <div class="col-lg-9 pt-5">
            <form action="<?php echo e(url('/')); ?>" class="js-search-input-form search-input-form mb-3" method="get">
                <div class="d-flex">
                    <div class="input-group w-50">
                        <input type="text" name="search" class="form-control" placeholder="Search Article..."
                            aria-label="Search" aria-describedby="search-addon" value="<?php echo e(app('request')->input('search')); ?>"/>
                        <button class="btn btn-light" type="submit" id="button-addon1"
                            style="background-color:#ffffff ; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>

                    <div class="input-group ms-2 w-25">
                        <select name="category" class="form-control">
                            <option value="">-- Category --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" 
                                    <?php if(app('request')->input('category') == $category->id): ?>
                                        selected
                                    <?php endif; ?>
                                    >
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php if(Gate::check('permission_create')): ?>
                    <div class="input-group ms-2 w-25">
                        <a href="<?php echo e(url('article/create')); ?>" class="btn btn-primary">Create Article
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="ms-1 bi bi-pen" viewBox="0 0 16 16">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>

                </div>

            </form>

            
            <div class="row  row-cols-1 row-cols-md-2 g-4" id="loadData">
                
            </div>

        </div>


        <div class="col-lg-3">
            <div class="sticky-md-top pt-1" style="z-index: 1;">
                <div class="mt-5 ">
                    
                </div>


                <div class="card">
                    <?php if(Gate::check('permission_create')): ?>
                        <div class="card-header">
                            <div class="header-title d-flex">
                                <h5 class="card-title">Your Article
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                    <?php if(Gate::check('permission_create')): ?>
                            <?php if($myArticle->count() == 0): ?>
                            <div class="col-md-12 mb-2">
                                <div class="text-center">
                                    <p>No Articles Found</p>
                                </div>
                            </div>
                            <?php else: ?>
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
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <h5 class="mb-3">All Categories
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
                
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    $(function() {
        function loadMoreData(id=0){
            axios.post('<?php echo e(route("load-article")); ?>',{ id : id, 
                category : <?php echo e(app('request')->input('category') ? app('request')->input('category') : 'null'); ?> != 'null' ? "<?php echo e(app('request')->input('category')  ? app('request')->input('category') : null); ?>" : null , 
                search : "<?php echo e(app('request')->input('search') ? app('request')->input('search') : null); ?>" != 'null' ? "<?php echo e(app('request')->input('search') ? app('request')->input('search') : null); ?>" : null })
            .then(res => {
                   $('#load_more_button').remove();
                   $('#loadData').append(res.data);
                   $('#load_more').insertAfter('#loadData');
            })
        }
        loadMoreData(0);
			$('body').on('click', '#load_more_button', function(){
			var id = $(this).data('id');
			$('#load_more_button').html('<b>Loading...</b>');
			loadMoreData(id);
            $('#load_more').remove();
		});
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/articles/home.blade.php ENDPATH**/ ?>