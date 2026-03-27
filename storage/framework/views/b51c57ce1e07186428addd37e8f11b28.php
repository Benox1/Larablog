<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <div class="p-6 border-b border-gray-200">
                <div class="text-center mb-6">
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        <?php echo e($article->title); ?>

                    </h2>
                    
                    <div class="text-gray-500 text-sm mt-2">
                        Publié le <?php echo e($article->created_at->format('d/m/Y')); ?> par <a href="<?php echo e(route('public.index', $article->user->id)); ?>" class="text-blue-500 hover:underline"><?php echo e($article->user->name); ?></a>
                    </div>
                </div>

                <!-- Badge Catégories -->
                <?php if($article->categories->count() > 0): ?>
                    <div class="mb-6 flex gap-2 justify-center">
                        <?php $__currentLoopData = $article->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded"><?php echo e($category->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <div class="prose max-w-none text-gray-800 leading-relaxed text-lg">
                    <?php echo nl2br(e($article->content)); ?>

                </div>
                
                <!-- Zone de Like (Bonus Tutoriel) -->
                <?php if(auth()->guard()->check()): ?>
                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-center">
                        <a href="<?php echo e(route('article.like', $article->id)); ?>" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                            </svg>
                            <span><?php echo e($article->likes ?? 0); ?> Like(s)</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- COMMENTAIRES (Étape 5) -->
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Commentaires (<?php echo e($article->comments->count()); ?>)</h3>
                
                <?php $__currentLoopData = $article->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm w-full md:w-3/4">
                        <div class="flex items-center mb-2 text-sm text-gray-600">
                            <span class="font-bold text-gray-800 mr-2"><?php echo e($comment->user->name); ?></span>
                            <span><?php echo e($comment->created_at->diffForHumans()); ?></span>
                        </div>
                        <p class="text-gray-700"><?php echo nl2br(e($comment->content)); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <!-- Ajouter un commentaire -->
                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('comments.store')); ?>" method="post" class="mt-8 border-t border-gray-200 pt-6">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="article_id" value="<?php echo e($article->id); ?>">
                        
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700 font-bold mb-2">Ajouter un commentaire :</label>
                            <textarea name="content" id="content" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Votre message..." required></textarea>
                        </div>
                        
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow">
                            Envoyer le commentaire
                        </button>
                    </form>
                <?php else: ?>
                    <div class="mt-6 text-center text-gray-600 p-4 bg-yellow-50 rounded border border-yellow-200">
                        Vous devez être <a href="<?php echo e(route('login')); ?>" class="text-blue-500 font-bold hover:underline">connecté</a> pour pouvoir publier un commentaire.
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Larablog\resources\views/public/show.blade.php ENDPATH**/ ?>