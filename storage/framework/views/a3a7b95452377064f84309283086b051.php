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
    <div class="text-center py-10">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
            Bienvenue sur <span class="text-blue-600">Larablog</span>
        </h1>
        <p class="mt-4 text-xl text-gray-500">
            Découvrez les articles les plus populaires de notre plateforme.
        </p>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12">
        <?php if($articles->isEmpty()): ?>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center text-lg">
                    Aucun article n'a été publié pour le moment.
                </div>
            </div>
        <?php else: ?>
            <div class="grid gap-8 lg:grid-cols-2">
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 transition hover:shadow-xl">
                    <div class="p-6 text-gray-900 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-2xl font-bold flex-1"><?php echo e($article->title); ?></h3>
                            <span class="inline-flex items-center justify-center px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full ml-4 whitespace-nowrap">
                                ❤️ <?php echo e($article->likes ?? 0); ?> Like(s)
                            </span>
                        </div>
                        
                        <!-- Badge Catégories -->
                        <?php if($article->categories->count() > 0): ?>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <?php $__currentLoopData = $article->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded"><?php echo e($category->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <p class="text-gray-600 mb-6 flex-grow"><?php echo e(substr($article->content, 0, 150)); ?>...</p>
                        
                        <div class="text-sm text-gray-500 mb-4 border-t border-gray-100 pt-4">
                            Publié le <?php echo e($article->created_at->format('d/m/Y')); ?> par <a href="<?php echo e(route('public.index', $article->user->id)); ?>" class="text-blue-500 font-semibold hover:underline"><?php echo e($article->user->name); ?></a>
                        </div>
                        
                        <div class="text-right">
                            <a href="<?php echo e(route('public.show', [$article->user_id, $article->id])); ?>" class="inline-block bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold py-2 px-4 rounded transition">Lire la suite &rarr;</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
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
<?php /**PATH C:\laragon\www\Larablog\resources\views/welcome.blade.php ENDPATH**/ ?>