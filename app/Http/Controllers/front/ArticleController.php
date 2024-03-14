<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SubCategory;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Str;

class ArticleController extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $subcategory = SubCategory::where('slug', $slug)->first();
            if (!$subcategory) {
                return abort(404);
            } else {
                $posts = Post::where('isActive' ,'=',  1)->where('category_id', $subcategory->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(2);
                $data = [
                    'pageTitle' => 'Subcategory - ' . $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts
                ];
                return view('front.pages.category_posts', $data);
            }
        }
    }

    public function searchBlog(Request $request)
    {
        $query = request()->query('query');
        if ($query && strlen($query) >= 2) {
            $searchValue = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();
            $posts->where(function ($q) use ($searchValue) {
                foreach ($searchValue as $value) {
                    $q->orWhere('post_title', 'LIKE', "%{$value}%");
                    $q->orWhere('post_tags', 'LIKE', "%{$value}%");
                }
            });

            $posts = Post::where('isActive' ,'=',  1)->with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            $data = [
                'pageTitle' => 'Search for :: ' . request()->query('query'),
                'posts' => $posts
            ];

            return view('front.pages.search_posts', $data);
        } else {
            return abort(404);
        }
    }

    public function readPost($slug)
    {

        if (!$slug) {
            abort(404);
        } else {
            $posts = Post::where('slug', $slug)
                ->with('subcategory')
                ->with('author')
                ->first();

            $posts_tags = explode(',', $posts->post_tags);
            $related_post = Post::where('id', '!=', $posts->id)
                ->where(function ($query) use ($posts_tags, $posts) {
                    foreach ($posts_tags as $item) {
                        $query->orWhere('post_tags', 'LIKE', "%$item%")
                            ->orWhere('post_title', 'LIKE', $posts->post_title);
                    }
                })
                ->inRandomOrder()
                ->take(3)
                ->get();
            $data = [
                'pageTitle' => Str::ucfirst($posts->post_title),
                'posts' => $posts,
                'related_post' => $related_post
            ];
            views($posts)->record();
            SEOMeta::setTitle($posts->title);
            SEOMeta::setDescription($posts->meta_desc);
            SEOMeta::addMeta('article:published_time', $posts->created_at->toW3CString(), 'property');
            SEOMeta::addMeta('article:section', $posts->subcategory->subcategory_name, 'property');
            SEOMeta::addKeyword($posts->meta_keywords);

            OpenGraph::setDescription($posts->meta_desc);
            OpenGraph::setTitle($posts->title);
            OpenGraph::setUrl('http://wksch-final.test/'.$posts->slug);
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('locale', 'id-ID');
            OpenGraph::addProperty('locale:alternate', ['en-us']);

            JsonLdMulti::setTitle($posts->title);
            JsonLdMulti::setDescription($posts->meta_desc);
            JsonLdMulti::setType('Article');
            // JsonLdMulti::addImage($posts->featured_image->list('url'));
            if(! JsonLdMulti::isEmpty()) {
                JsonLdMulti::newJsonLd();
                JsonLdMulti::setType('WebPage');
                JsonLdMulti::setTitle('Page Article - '.$posts->title);
            }
            OpenGraph::setTitle($posts->title)
            ->setDescription($posts->meta_desc)
            ->setType('article')
            ->setArticle([
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
                'expiration_time' => 'datetime',
                'author' => $posts->author->name,
                'section' => $posts->subcategory->subcategory_name,
                'tag' => $posts->post_tags
            ]);
            return view('front.pages.single_post', $data);

        }
    }

    public function tagPost(Request $request, $tag)
    {
        $posts = Post::where('isActive' ,'=',  1)->where('post_tags', 'LIKE', '%' . $tag . '%')
            ->with('subcategory')
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        if (!$posts) {
            return abort(404);
        }

        $data = [
            'pageTitle' => '#' . $tag,
            'posts' => $posts
        ];
        return view('front.pages.tags_post', $data);
    }
}
