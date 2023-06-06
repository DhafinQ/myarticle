
<?php $__env->startSection('title'); ?>
    <?php if(!empty($article->title)): ?>
    MyArticle | Update <?php echo e($article->title); ?>

    <?php else: ?>
    MyArticle | Create Article 
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <script src="<?php echo e(asset('js/tinymce/tinymce.min.js')); ?>"></script>
    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: ["lists","stylebuttons"],
        promotion: false,
        toolbar: ['undo redo | styles | bold italic | indent outdent bullist numlist | alignleft aligncenter alignright'],
        menubar: '',
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
             <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <h4 class="card-title"><?php echo e(empty($article->title) ? 'Create' : 'Edit'); ?> Article</h4>
                </div>
             </div>
            <?php if(empty($article->title)): ?>
             <form action="<?php echo e(route('article.store')); ?>" method="post" enctype="multipart/form-data">
            <?php else: ?>
            <form action="<?php echo e(route('article.update',$article->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('PATCH'); ?>
             <?php endif; ?>
                <?php echo csrf_field(); ?>
                <div class="card-body">
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('title')): ?>
                                <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Title Article<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="<?php if(!empty(old('title'))): ?><?php echo e(old('title')); ?><?php else: ?><?php echo e(!empty($article->title) ? $article->title : ''); ?><?php endif; ?>" id="title" name="title" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('category')): ?>
                                <span class="text-danger"><?php echo e($errors->first('category')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Category<span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">-- Category --</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php if(!empty(old('category'))): ?>
                                        <?php echo e(old('category') == $category->id ? 'selected' : ''); ?>

                                    <?php else: ?>
                                        <?php echo e(!empty($article->title) ? $article->category_id == $category->id ? 'selected' : '' : ''); ?>

                                    <?php endif; ?>
                                    >
                                    <?php echo e($category->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                       </div>
                   </div> 
                   <div class="col-sm-12">
                       <div class="form-group">
                            <?php if($errors->has('content')): ?>
                                <span class="text-danger"><?php echo e($errors->first('content')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Content<span class="text-danger">*</span></label>
                           <textarea name="content" id="content">
                            <?php echo (!empty(old('content')) ? old('content') : !empty($article->content)) ? $article->content : ''; ?>

                           </textarea>
                       </div>
                   </div>
                   <div class="col-sm-6">
                        <div class="form-group">
                            <?php if($errors->has('banner')): ?>
                                <span class="text-danger"><?php echo e($errors->first('banner')); ?></span>
                                <br>
                            <?php endif; ?>
                            <label for="s">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="banner" name="banner" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <img alt="Preview" id="banner_img" class="img-fluid mb-3"
                        <?php if(!empty($article->banner)): ?>
                        src="<?php echo e($article->getBanner()); ?>"
                        <?php endif; ?>
                        >
                    </div>
                   <div class="col-sm-8 d-flex">
                       <div class="form-group">
                           <button class="btn btn-primary" type="submit"><?php echo e(empty($article->title) ? 'Add' : 'Edit'); ?></button>
                       </div>
                       <div class="form-group ms-2">
                           <a class="btn btn-secondary" href="">Cancel</a>
                       </div>
                   </div>
                 </div>
                </div>
            </form>
          </div>
       </div>
    </div>

    <script>
        <?php if(empty($article->title)): ?>
        document.getElementById('banner_img').style.display = "none";
        <?php else: ?>
        document.getElementById('banner_img').style.display = "block";
        <?php endif; ?>

        var loadFile = function(event) {
            document.getElementById('banner_img').style.display = "block";
            var output = document.getElementById('banner_img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src);
          }
        };
      </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/master/article-create.blade.php ENDPATH**/ ?>