<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
final class ColorAdmin extends AbstractAdmin
{
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('r')
            ->add('g')
            ->add('b')
            ->add('material')
            ->add('enabled')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('r')
            ->addIdentifier('g')
            ->addIdentifier('b')
            ->add('material')
            ->add('enabled', null, ['editable' => true])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('r')
            ->add('g')
            ->add('b')
            ->add('material')
            ->add('enabled')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->tab('Color tab')
            ->with('Color R', ['class' => 'col-12'])
            ->add('r')
            ->end()
            ->with('Color G', ['class' => 'col-6'])
            ->add('g')
            ->end()
            ->with('Color B', ['class' => 'col-6'])
            ->add('b')
            ->end()
            ->end()
            ->tab('Other tab')
            ->with('Other pane')
            ->add('material', AdminType::class)
            ->add('enabled')
            ->end()
            ->end()
        ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null): void
    {
        if (!$childAdmin && !\in_array($action, ['edit'], true)) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');
        $product = $this->getObject($id);

        $menu->addChild(
            'Test',
            ['uri' => '#']
        );

        $menu->addChild(
            'Test 2',
            ['uri' => '#']
        );

        $menu->addChild(
            'Test 3',
            ['uri' => '#']
        );
    }
}
